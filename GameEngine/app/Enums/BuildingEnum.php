<?php

namespace App\Enums;

use Illuminate\Validation\Rules\Enum;

enum Building: int
{
    case UNKNOWN = 0;
    case WOODCUTTER = 1;
    case CLAYPIT = 2;
    case IRONMINE = 3;
    case CROPLAND = 4;
    case SAWMILL = 5;
    case BRICKYARD = 6;
    case GRAINMILL = 7;
    case IRONFOUNDRY = 8;
    case BAKERY = 9;
    case WAREHOUSE = 10;
    case GRANARY = 11;
    case BLACKSMITH = 12;
    case ARMOURY = 13;
}
