<?php

namespace App\Utilities\Enum;

use App\Utilities\Enum\Traits\BasicEnumTrait;

enum PermissionTypeEnum: string
{
    use BasicEnumTrait;

    case url = 'url';
    case slug = 'slug';
}
