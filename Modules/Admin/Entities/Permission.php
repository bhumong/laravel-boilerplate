<?php

namespace Modules\Admin\Entities;

use App\Models\Permission as ModelPermission;

class Permission extends ModelPermission
{
    protected $relationsClass = [
        'role' => Role::class
    ];
}
