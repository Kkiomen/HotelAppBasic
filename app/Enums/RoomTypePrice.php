<?php

namespace App\Enums;

use Illuminate\Support\Facades\Lang;

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

    public static function toSelect(): array
    {
        return [
            self::PER_PERSON->value => Lang::get('room.per_person'),
            self::PER_PLACE->value => Lang::get('room.per_place'),
        ];
    }
}
