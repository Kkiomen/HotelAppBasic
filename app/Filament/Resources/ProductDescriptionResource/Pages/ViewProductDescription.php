<?php

namespace App\Filament\Resources\ProductDescriptionResource\Pages;

use App\Filament\Resources\ProductDescriptionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewProductDescription extends ViewRecord
{
    protected static string $resource = ProductDescriptionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
