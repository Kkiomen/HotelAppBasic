<?php

namespace App\Enums;

enum RoomTypePrice: string
{
    case PER_PERSON = 'per_person';
    case PER_PLACE = 'per_place';

    public static function toArray(): array
    {
        return [
            self::PER_PERSON->value,
            self::PER_PLACE->value
        ];
    }
}
