<?php

namespace App\Services\Decorators\PromptProductDescription;

use App\Services\Decorators\PromptProductDescriptionDecorator;

class WarrantyPromptProductDescriptionDecorator extends PromptProductDescriptionDecorator
{
    public function getPrompt(): string
    {
        return $this->preparePromptByLangKey('prompt.warranty');
    }
}
