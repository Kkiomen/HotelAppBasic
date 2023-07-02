<?php

namespace App\Filament\Resources\ReservationResource\Pages;

use App\Filament\Resources\ReservationResource;
use App\Models\Hotel;
use App\Models\Reservation;
use App\Models\ReservationRoom;
use App\Models\Room;
use App\Services\UserHistoryServices\Enums\HistoryActionEnum;
use App\Services\UserHistoryServices\UserHistoryService;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class ChangingReservationRoom extends Page implements HasForms, HasTable
{

    use InteractsWithForms, InteractsWithTable;

    protected static string $resource = ReservationResource::class;

    protected static string $view = 'filament.resources.reservation-resource.pages.changing-reservation-room';


    public Reservation $reservation;
    public $rooms = [];
    public $reservationRoomsAll = [];

    public $freeRooms = [];
    public $roomsWithAvailability = [];

    public function mount($record): void
    {
        $this->reservation = Reservation::where('hotel_id', Auth::user()->active_hotel)->where('id', $record)->first();
        $this->form->fill();

        if($this->reservation){
            $this->rooms = Room::where('hotel_id', Auth::user()->active_hotel)->get();
            $this->reservationRoomsAll = $this->getUserRoom();

            // $this->freeRooms = DB::table('rooms')
            //                             ->where('rooms.hotel_id', Auth::user()->active_hotel)
            //                             ->whereNotIn('rooms.id', function($query) use ($check_in, $check_out) {
            //                                 $query->select('reservation_room.room_id')
            //                                       ->from('reservation_room')
            //                                       ->join('reservations', 'reservations.id', '=', 'reservation_room.reservation_id')
            //                                       ->where(function($query) use ($check_in, $check_out) {
            //                                           $query->where('reservations.check_in', '>', $check_in)
            //                                                 ->where('reservations.check_out', '<', $check_out);
            //                                       });
            //                             })
            //                             ->get();

            $this->roomsWithAvailability = $this->getAvailableRoom();
        }

    }

    public function getTitle(): string
    {
        return Lang::get('room.manage_room');
    }

    public static function getNavigationLabel(): string
    {
        return Lang::get('room.manage_room');
    }

    protected function getFormSchema(): array
    {
        $this->roomsWithAvailability = $this->getAvailableRoom();
        $this->reservationRoomsAll = $this->getUserRoom();
        $options = [];

       // dump($this->roomsWithAvailability);
        foreach($this->roomsWithAvailability as $room){
            $available = $room?->is_available == 1 ? 'available' : 'unavailable';
            $options[$room->id] = $room->number_place . ' - ' .  Lang::get('form.'.$available);
        }


        return [
            Grid::make()->schema([
                Select::make('roomId')
                ->searchable()
                ->label(Lang::get('room.choose_room'))
                ->options($options)
                ->columnSpanFull()
                ->disablePlaceholderSelection(),
            ])
        ];
    }

    public function submit(): void
    {
        $this->roomsWithAvailability = $this->getAvailableRoom();
        $dataForm = $this->form->getState();
        if(ReservationRoom::where('reservation_id', $this->reservation->id)->where('room_id', $dataForm['roomId'])->first()){
            Notification::make()->title(Lang::get('room.error_unavailable_room'))->danger()->send();
            return;
        }

        $room = Room::where('id', $dataForm['roomId'])->first();
        ReservationRoom::create([
            'reservation_id' => $this->reservation->id,
            'room_id' => $dataForm['roomId'],
            'hotel_id' => Auth::user()->active_hotel,
            'room_number_place' => $room->number_place
        ]);
        $this->roomsWithAvailability = $this->getAvailableRoom();
        $this->reservationRoomsAll = $this->getUserRoom();
        UserHistoryService::addReservationHistory(HistoryActionEnum::ADD_RESERVATION_ROOM, [
            'reservation_id' => $this->reservation->id,
            'reservation_name' => $this->reservation->name,
            'room_id' => $dataForm['roomId'],
            'hotel_id' => Auth::user()->active_hotel,
            'room_number_place' => $room->number_place
        ], $this->reservation->id);
        Notification::make()->title(Lang::get('room.success_unavailable_room'))->success()->send();
    }

    protected function getTableQuery(): Builder
    {
        return ReservationRoom::query()
            ->where('reservation_id', $this->reservation->id)
            ->where('hotel_id', Auth::user()->active_hotel);
    }

    public static function getEloquentQuery(): Builder
    {

        return parent::getEloquentQuery()
            ->where('hotel_id', Auth::user()->active_hotel)
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
                RoomScope::class
            ]);
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('room_number_place')
                ->searchable()
                ->sortable()
                ->label(Lang::get('room.room_number_place')),
        ];
    }

    protected function getTableRecordsPerPageSelectOptions(): array
    {
        return [30];
    }

    protected function getTableActions(): array
    {
        return [
            DeleteAction::make()
                ->before(function (DeleteAction $action) {
                    UserHistoryService::addReservationHistory(HistoryActionEnum::DELETE_RESERVATION_ROOM,[
                        'reservation' => $action->getRecord()->reservation->toArray(),
                        'room' => $action->getRecord()->room->toArray()
                    ],$action->getRecord()->reservation->id);
            }),
        ];
    }

    private function getAvailableRoom()
    {
        $check_in = $this->reservation->check_in ?? now();
        $check_out = $this->reservation->check_out ?? now();

        return DB::table('rooms')
        ->select('rooms.*')
        ->selectRaw('
            CASE
                WHEN EXISTS (
                    SELECT 1
                    FROM reservation_room
                    JOIN reservations ON reservations.id = reservation_room.reservation_id
                    WHERE reservation_room.room_id = rooms.id
                    AND (
                        (reservations.check_in > ? AND reservations.check_out < ?)
                    )
                )
                THEN 0
                ELSE 1
            END as is_available', [$check_in, $check_out])
        ->where('rooms.hotel_id', Auth::user()->active_hotel)
        ->orderBy('is_available', 'desc')
        ->get();
    }

    private function getUserRoom(){
        return DB::table('reservation_room')
        ->where('reservations.hotel_id', Auth::user()->active_hotel)
        ->join('reservations', 'reservations.id', '=', 'reservation_room.reservation_id')
        ->join('rooms', 'rooms.id', '=', 'reservation_room.room_id')
        ->get();
    }

}
