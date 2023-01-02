<?php

namespace App\Utilities\Enum;

use App\Utilities\Enum\Traits\BasicEnumTrait;

enum TimeEnum: int
{
    use BasicEnumTrait;

    case oneMinuteInSecond = 60;
    case oneHourInSecond = 3600;
    case oneDayInSecond = 86400;
}
