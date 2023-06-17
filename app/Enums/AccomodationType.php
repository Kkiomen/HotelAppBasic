<?php

namespace App\Enums;

enum AccomodationType: string
{
    case ROOM = 'room';
    case TENT = 'tent';
    case PLACE = 'place';
    case HOUSE = 'house';
    case OTHER = 'other';

    public static function toArray(): array
    {
        return [
            self::ROOM->value,
            self::TENT->value,
            self::PLACE->value,
            self::HOUSE->value,
            self::OTHER->value
        ];
    }
}
