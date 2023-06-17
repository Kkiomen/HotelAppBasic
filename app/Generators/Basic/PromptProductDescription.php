<?php

namespace App\Generators\Basic;

use App\Interfaces\PromptProductDescriptionInterface;
use Illuminate\Support\Facades\Lang;

class PromptProductDescription implements PromptProductDescriptionInterface
{

    public function getPrompt(): string
    {
        return Lang::get('prompt.create_attractive_description');
    }
}
