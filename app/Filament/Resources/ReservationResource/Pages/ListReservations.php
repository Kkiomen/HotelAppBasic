<?php

namespace App\Filament\Resources\ReservationResource\Pages;

use App\Filament\Resources\ReservationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Lang;

class ListReservations extends ListRecords
{
    protected static string $resource = ReservationResource::class;

    public function getTitle(): string
    {
        return Lang::get('reservation.base');
    }

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
