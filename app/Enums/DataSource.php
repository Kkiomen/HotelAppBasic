<?php

namespace App\Enums;

enum DataSource: string
{
    case API = 'api';
    case FORM = 'form';

    case MODEL = 'model';
}
