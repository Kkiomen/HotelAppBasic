<?php

namespace App\Services\Decorators\PromptProductDescription;

use App\Services\Decorators\PromptProductDescriptionDecorator;

class AttributesPromptProductDescriptionDecorator extends PromptProductDescriptionDecorator
{
    public function getPrompt(): string
    {
        return $this->preparePromptByLangKey('prompt.attributes', $this->attributesToString($this->attribute, true));
    }
}

