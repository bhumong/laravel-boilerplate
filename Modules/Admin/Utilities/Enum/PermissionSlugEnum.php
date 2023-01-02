<?php

namespace Modules\Admin\Utilities\Enum;

use App\Utilities\Enum\Traits\BasicEnumTrait;

enum PermissionSlugEnum: string
{
    use BasicEnumTrait;

    case adminUserIndex = 'admin::user/index';
    case adminUserGet = 'admin::user/get';
    case adminUserCreate = 'admin::user/create';
    case adminUserDelete = 'admin::user/delete';
    case adminUserUpdate = 'admin::user/update';

    case adminRoleIndex = 'admin::role/index';
    case adminRoleGet = 'admin::role/get';
    case adminRoleCreate = 'admin::role/create';
    case adminRoleDelete = 'admin::role/delete';
    case adminRoleUpdate = 'admin::role/update';
    case adminRoleApplyChange = 'admin::role/applyChange';

    case adminPermissionIndex = 'admin::permission/index';
    case adminPermissionGet = 'admin::permission/get';
    case adminPermissionCreate = 'admin::permission/create';
    case adminPermissionDelete = 'admin::permission/delete';
    case adminPermissionUpdate = 'admin::permission/update';
    case adminPermissionGenerate = 'admin::permission/generate';
}
