<?php

namespace App\Filament\Resources\ProductDescriptionResource\Pages;

use App\Enums\DataSource;
use App\Filament\Resources\ProductDescriptionResource;
use App\Products\ProductDescription;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProductDescription extends CreateRecord
{
    protected static string $resource = ProductDescriptionResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        $productDescription = new ProductDescription(DataSource::FORM, $data);
        $generatedDescription = $productDescription->getResult();
        $data['result'] = $generatedDescription['result'];
        $data['generated_prompt'] = $generatedDescription['prompt'];
        return $data;
    }

}
