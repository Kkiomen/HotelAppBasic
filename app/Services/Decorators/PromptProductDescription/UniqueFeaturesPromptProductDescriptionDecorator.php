<?php

namespace App\Services\Decorators\PromptProductDescription;

use App\Services\Decorators\PromptProductDescriptionDecorator;

class UniqueFeaturesPromptProductDescriptionDecorator extends PromptProductDescriptionDecorator
{
    public function getPrompt(): string
    {
        if(empty($this->attribute)){
            return parent::getPrompt();
        }

        return $this->preparePromptByLangKey('prompt.uniqueFeatures', $this->attributesToString($this->attribute)) . parent::DOT;
    }
}
