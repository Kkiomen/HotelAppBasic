<?php

namespace App\Filament\Resources\ReservationResource\Pages;

use App\Filament\Resources\ReservationResource;
use App\Services\UserHistoryServices\Enums\HistoryActionEnum;
use App\Services\UserHistoryServices\UserHistoryService;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateReservation extends CreateRecord
{
    protected static string $resource = ReservationResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['hotel_id'] = Auth::user()->active_hotel;
        return $data;
    }

    protected function handleRecordCreation(array $data): \Illuminate\Database\Eloquent\Model
    {
        $model = static::getModel()::create($data);
        UserHistoryService::addReservationHistory(HistoryActionEnum::ADD_RESERVATION, $model->toArray(), $model->id);
        return $model;
    }

}
