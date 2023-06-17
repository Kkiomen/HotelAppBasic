<?php

namespace App\Filament\Resources\ProductDescriptionResource\Pages;

use App\Filament\Resources\ProductDescriptionResource;
use App\Models\ProductDescription;
use Filament\Notifications\Notification;
use Filament\Pages\Actions\Action;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;

class ListProductDescriptions extends ListRecords
{
    protected static string $resource = ProductDescriptionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Action::make(Lang::get('product_description.clear_database'))->action('clearDatabase'),
        ];
    }

    public function getTitle(): string
    {
        return Lang::get('product_description.list_tile');
    }

    public function clearDatabase(){
        ProductDescription::truncate();
        Notification::make()
            ->title(Lang::get('notifications.success_clear'))
            ->success()
            ->send();
    }
}
