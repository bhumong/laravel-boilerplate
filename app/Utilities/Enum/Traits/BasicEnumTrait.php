<?php

namespace App\Utilities\Enum\Traits;

use Arr;

trait BasicEnumTrait
{
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function array(): array
    {
        return array_combine(self::values(), self::names());
    }

    public static function random()
    {
        return Arr::random(self::array());
    }
}
