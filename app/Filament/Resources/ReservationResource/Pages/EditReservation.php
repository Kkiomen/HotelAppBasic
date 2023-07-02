<?php

namespace App\Filament\Resources\ReservationResource\Pages;

use App\Filament\Resources\ReservationResource;
use App\Services\UserHistoryServices\Enums\HistoryActionEnum;
use App\Services\UserHistoryServices\UserHistoryService;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditReservation extends EditRecord
{
    protected static string $resource = ReservationResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $old = $record->toArray();
        $record->update($data);
        UserHistoryService::addReservationHistory(HistoryActionEnum::EDIT_RESERVATION, [
            'old' => $old,
            'new' => $record->toArray(),
            'changed' => $record->getChanges()
        ], $record->id);
        return $record;
    }
}
