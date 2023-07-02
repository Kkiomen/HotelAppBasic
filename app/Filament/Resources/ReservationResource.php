<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReservationResource\Pages;
use App\Filament\Resources\ReservationResource\Pages\ChangingReservationRoom;
use App\Filament\Resources\ReservationResource\RelationManagers;
use App\Filament\Resources\ReservationResource\RelationManagers\GuestRelationManager;
use App\Filament\Resources\ReservationResource\RelationManagers\RoomRelationManager;
use App\Models\Reservation;
use App\Models\Room;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class ReservationResource extends Resource
{
    protected static ?string $model = Reservation::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->label(Lang::get('form.name'))->columnSpanFull(),
                DateTimePicker::make('check_in')->label(Lang::get('reservation.check_in'))->columnSpanFull(),
                DateTimePicker::make('check_out')->label(Lang::get('reservation.check_out'))->columnSpanFull(),
                Textarea::make('description')->label(Lang::get('reservation.description'))->columnSpanFull(),
                Grid::make(2)
                    ->schema([
                        TextInput::make('number_adult')->label(Lang::get('reservation.number_adult'))->numeric(),
                        TextInput::make('number_child')->label(Lang::get('reservation.number_child'))->numeric(),
                    ]),
                Textarea::make('room_preference')->label(Lang::get('reservation.room_preference'))->columnSpanFull(),
                Placeholder::make(Lang::get('reservation.invoice_details'))
                    ->content(Lang::get('reservation.invoice_details_description')),
                TextInput::make('name_reservation_person')->label(Lang::get('reservation.name_reservation_person'))->columnSpanFull(),
                Grid::make(3)
                    ->schema([
                        Forms\Components\TextInput::make('nip')
                            ->label('NIP')
                            ->numeric()
                            ->maxLength(10),
                        Forms\Components\TextInput::make('regon')
                            ->label('REGON')
                            ->numeric()
                            ->maxLength(10),
                        Forms\Components\TextInput::make('krs')
                            ->label('KRS')
                            ->numeric()
                            ->maxLength(10),
                    ]),
                Forms\Components\TextInput::make('address')->label(Lang::get('form.address'))->columnSpanFull(),
                Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('postal_code')
                        ->label(Lang::get('form.postal_code')),
                        Forms\Components\TextInput::make('city')
                            ->label(Lang::get('form.city')),
                        ]),
                Forms\Components\TextInput::make('country')
                    ->label(Lang::get('form.country'))->columnSpanFull(),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->label(Lang::get('form.phone'))->columnSpanFull(),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->label(Lang::get('form.email'))->columnSpanFull(),
                Checkbox::make('can_pay_by_wallet')->label(Lang::get('reservation.can_pay_by_wallet'))->helperText(Lang::get('reservation.can_pay_by_wallet_description'))->columnSpanFull(),
                Checkbox::make('can_use_wallet')->label(Lang::get('reservation.can_use_wallet'))->helperText(Lang::get('reservation.can_use_wallet_description'))->columnSpanFull(),
                Checkbox::make('cost_breakdown')->label(Lang::get('reservation.cost_breakdown'))->helperText(Lang::get('reservation.cost_breakdown_description'))->columnSpanFull(),
                Checkbox::make('purchase_by_other_guests')->label(Lang::get('reservation.purchase_by_other_guests'))->helperText(Lang::get('reservation.purchase_by_other_guests_description'))->columnSpanFull(),
                Checkbox::make('is_active')->label(Lang::get('reservation.is_active'))->columnSpanFull(),
                Checkbox::make('paid_reservation')->label(Lang::get('reservation.paid_reservation'))->helperText(Lang::get('reservation.paid_reservation_description'))->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(Lang::get('reservation.name'))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('check_in')
                    ->label(Lang::get('reservation.check_in'))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('check_out')->label(Lang::get('reservation.check_out'))
                    ->sortable()
                    ->searchable(),

                TextColumn::make('number_adult')->label(Lang::get('reservation.number_adult')),
                TextColumn::make('room')->label(Lang::get('reservation.room'))->getStateUsing( function (Model $record){
                    return $record->room()->get()->map(function ($item, $key) {
                        return $item?->name;
                    })->implode(', ');
                 }),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RoomRelationManager::class,
            GuestRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReservations::route('/'),
            'create' => Pages\CreateReservation::route('/create'),
            'edit' => Pages\EditReservation::route('/{record}/edit'),
            'room' => ChangingReservationRoom::route('/{record}/room')
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('hotel_id', Auth::user()->active_hotel)
        ->orderBy(DB::raw('ABS(DATEDIFF(check_in, NOW()))'))
        ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getNavigationLabel(): string
    {
        return Lang::get('reservation.base');
    }

    public static function getBreadcrumb(): string
    {
        return Lang::get('reservation.base');
    }

}
