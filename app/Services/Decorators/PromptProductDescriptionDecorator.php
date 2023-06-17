<?php

namespace App\Services\Decorators;

use App\Interfaces\PromptProductDescriptionInterface;
use Illuminate\Support\Facades\Lang;

class PromptProductDescriptionDecorator implements PromptProductDescriptionInterface
{
    const SPACE = ' ';
    const DOT = '.';

    protected PromptProductDescriptionInterface $component;
    protected mixed $attribute;
    public function __construct(PromptProductDescriptionInterface $component, mixed $attribute = '')
    {
        $this->component = $component;
        $this->attribute = $attribute;
    }

    /**
     * Return created prompt
     * @return string
     */
    public function getPrompt(): string
    {
        return $this->component->getPrompt();
    }

    /**
     * Prepares a prompt string using a language key.
     * @param string $langKey
     * @return string
     */
    protected function preparePromptByLangKey(string $langKey, $attribute = null): string
    {
        $attribute = $attribute ?? $this->attribute ?? '';
        return self::getPrompt() . self::SPACE . Lang::get($langKey) . self::SPACE . $attribute;
    }

    /**
     * Method prepares arrays of attributes to a string, which are better understood by the Open AI API
     * @param array $attributes
     * @param bool $isAssociationArray
     * @return string
     */
    protected function attributesToString(array $attributes, bool $isAssociationArray = false): string
    {

        try{
            if($isAssociationArray === true){
                $attributes = array_map(function($attribute) {
                    if(is_string($attribute)){
                        return $attribute;
                    }else{
                        $key = key($attribute);
                        $value = $attribute[$key];
                        return "$key: $value";
                    }
                }, $attributes);
            }
        }catch (\Exception $e){}

        return implode(", ", $attributes);
    }
}
