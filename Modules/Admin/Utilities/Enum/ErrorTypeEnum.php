<?php

namespace Modules\Admin\Utilities\Enum;

use App\Utilities\Enum\Traits\BasicEnumTrait;

enum ErrorTypeEnum: string
{
    use BasicEnumTrait;

    case flashMessage = 'flashMessage';
}
