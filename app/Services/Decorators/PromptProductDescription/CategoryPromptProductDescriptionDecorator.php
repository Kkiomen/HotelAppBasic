<?php

namespace App\Services\Decorators\PromptProductDescription;

use App\Services\Decorators\PromptProductDescriptionDecorator;

class CategoryPromptProductDescriptionDecorator extends PromptProductDescriptionDecorator
{
    public function getPrompt(): string
    {
        return $this->preparePromptByLangKey('prompt.from_category') . ',';
    }
}

