<?php

namespace Modules\Admin\Enum;

use App\Utilities\Enum\Traits\BasicEnumTrait;

enum PermissionSlugEnum: string
{
    use BasicEnumTrait;

    case adminUserIndex = 'admin::user/index';
    case adminUserGet = 'admin::user/get';
    case adminUserCreate = 'admin::user/create';
    case adminUserDelete = 'admin::user/delete';
    case adminUserUpdate = 'admin::user/update';
}
