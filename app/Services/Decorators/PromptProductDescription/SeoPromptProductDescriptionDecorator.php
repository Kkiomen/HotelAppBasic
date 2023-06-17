<?php

namespace App\Services\Decorators\PromptProductDescription;

use App\Services\Decorators\PromptProductDescriptionDecorator;
use Illuminate\Support\Facades\Lang;

class SeoPromptProductDescriptionDecorator extends PromptProductDescriptionDecorator
{
    private $seoList = '';

    public function getPrompt(): string
    {
        if(empty($this->attribute)){
            return parent::getPrompt();
        }

        return $this->preparePromptByLangKey('prompt.seo_keyword', $this->seoList) . parent::DOT . parent::SPACE . Lang::get('prompt.seo_description') . parent::DOT;
    }

}
