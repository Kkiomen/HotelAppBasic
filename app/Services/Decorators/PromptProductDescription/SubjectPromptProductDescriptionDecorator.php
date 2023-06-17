<?php

namespace App\Services\Decorators\PromptProductDescription;

use App\Services\Decorators\PromptProductDescriptionDecorator;

class SubjectPromptProductDescriptionDecorator extends PromptProductDescriptionDecorator
{
    public function getPrompt(): string
    {
        return $this->preparePromptByLangKey('prompt.for_subject');
    }
}

