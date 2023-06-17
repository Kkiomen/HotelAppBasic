<?php

namespace App\Enums;

enum GeneratorStatus: int
{
    case TO_GENERATE = 0;
    case GENERATED = 1;
    case GENERATE = 2;
    case FAIL = 3;

}
