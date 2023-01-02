<?php

namespace Modules\Admin\Entities;

use App\Models\Role as ModelsRole;

class Role extends ModelsRole
{
    protected $relationsClass = [
        'permission' => Permission::class,
        'user' => User::class,
    ];
}
