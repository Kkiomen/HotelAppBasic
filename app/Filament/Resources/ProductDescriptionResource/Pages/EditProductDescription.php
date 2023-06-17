<?php

namespace App\Filament\Resources\ProductDescriptionResource\Pages;

use App\Enums\DataSource;
use App\Filament\Resources\ProductDescriptionResource;
use App\Jobs\GenerateProductDescriptionJob;
use App\Products\ProductDescription;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProductDescription extends EditRecord
{
    protected static string $resource = ProductDescriptionResource::class;


    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['user_id'] = auth()->id();
        $productDescription = new ProductDescription(DataSource::FORM, $data);
        //dd($productDescription->preparePrompt());
        $data['generated_prompt'] = $productDescription->preparePrompt();
        $data['generated'] = 0;
        return $data;
    }

    protected function afterSave(): void
    {
        GenerateProductDescriptionJob::dispatch('add description');
    }

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
