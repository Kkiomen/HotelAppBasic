<?php

namespace App\Enums;

use App\Models\User;

enum RolesType: string
{
    case USER = 'user';
    case CLIENT = 'client';
    case GUEST = 'guest';
    case ADMINISTRATOR = 'administrator';
    case EMPLOYEE = 'employee';

    public static function toArray(): array
    {
        return [
            self::USER->value,
            self::CLIENT->value,
            self::GUEST->value,
            self::EMPLOYEE->value,
            self::ADMINISTRATOR->value
        ];
    }


}
