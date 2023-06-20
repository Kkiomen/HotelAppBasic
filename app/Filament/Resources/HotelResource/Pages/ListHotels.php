<?php

namespace App\Filament\Resources\HotelResource\Pages;

use App\Filament\Resources\HotelResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Lang;

class ListHotels extends ListRecords
{
    protected static string $resource = HotelResource::class;

    public function getTitle(): string
    {
        return Lang::get('hotel.base');
    }
    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
