<?php

namespace App\Enums;

use Illuminate\Support\Facades\Lang;

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

    public static function toSelect(): array
    {
        return [
            self::ROOM->value => Lang::get('room.accommodation_type_room'),
            self::TENT->value => Lang::get('room.accommodation_type_tent'),
            self::PLACE->value => Lang::get('room.accommodation_type_place'),
            self::HOUSE->value => Lang::get('room.accommodation_type_house'),
            self::OTHER->value => Lang::get('form.other')
        ];
    }
}
