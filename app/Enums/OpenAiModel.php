<?php

namespace App\Enums;

enum OpenAiModel: string
{
    case DAVINCI = 'text-davinci-003';
    case CHAT_GPT_3 = 'gpt-3.5-turbo';

    public static function toArray(){
        return [
            self::DAVINCI->value,
            self::CHAT_GPT_3->value,
        ];
    }
}

