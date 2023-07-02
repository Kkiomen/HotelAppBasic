<?php

namespace App\Filament\Pages;

use App\Models\UserHistory;
use App\Services\UserHistoryServices\Enums\HistoryActionEnum;
use App\Services\UserHistoryServices\UserHistoryService;
use Filament\Pages\Actions\Action;
use Filament\Pages\Page;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class HistoryHotel extends Page implements HasTable
{
    use InteractsWithTable;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.history-hotel';

    public Collection $history;

    public function mount()
    {
        $this->history = UserHistory::where('hotel_id', Auth::user()->active_hotel)
            ->get();
    }

    protected function getTableQuery(): Builder
    {
        return UserHistory::query()->where('hotel_id', Auth::user()->active_hotel)->orderBy('created_at', 'desc');
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('user_id')
                ->label(Lang::get('form.user'))
                ->sortable()
                ->searchable()
                ->getStateUsing( function (Model $record){
                    return $record->user->name;
                }),
            TextColumn::make('action')
//                ->icon(function (Model $record){
//                    return UserHistoryService::getIcon($record);
//                })
                ->label(Lang::get('history.action'))
                ->sortable()
                ->searchable()
                ->html()
                ->getStateUsing( function (Model $record){
                    return UserHistoryService::getInformation($record);
                }),
            TextColumn::make('created_at')
                ->label(Lang::get('form.created_at'))
                ->sortable()
                ->searchable()
                ->date('d.m.Y H:i')
            ];
    }

    protected function getTableActions(): array
    {
        return [
            \Filament\Tables\Actions\Action::make('details')
            ->label(Lang::get('form.details'))
            ->action(fn () => null)
            ->modalHeading(fn ($record) => strip_tags(UserHistoryService::getTitle($record)))
            ->modalContent(fn ($record) => view('filament.modal.details-history', [
                'record' => UserHistoryService::getDetails($record),
            ]))
        ];
    }


    public function getTitle(): string
    {
        return Lang::get('history.history_hotel');
    }

    public static function getNavigationLabel(): string
    {
        return Lang::get('history.history_hotel');
    }
}
