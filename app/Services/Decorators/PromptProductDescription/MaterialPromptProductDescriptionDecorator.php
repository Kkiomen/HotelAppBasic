<?php

namespace App\Services\Decorators\PromptProductDescription;

use App\Services\Decorators\PromptProductDescriptionDecorator;

class MaterialPromptProductDescriptionDecorator extends PromptProductDescriptionDecorator
{
    public function getPrompt(): string
    {
        if(empty($this->attribute)){
            return parent::getPrompt();
        }
        return $this->preparePromptByLangKey('prompt.material', $this->attributesToString($this->attribute)) . parent::DOT;
    }
}
