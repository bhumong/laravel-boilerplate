<?php

namespace Modules\Admin\Utilities\Enum;

use App\Utilities\Enum\Traits\BasicEnumTrait;

enum FlashEnum: string
{
    use BasicEnumTrait;

    case error = 'flash.error';
    case success = 'flash.success';
}
