<?php

namespace Modules\Admin\Entities;

use App\Models\Role;
use App\Models\User as ModelsUser;
use Modules\Admin\Services\Rbac\RbacUserInterface;

class User extends ModelsUser implements RbacUserInterface
{
    protected $relationsClass = [
        'role' => Role::class,
    ];

    public function getRole(): Role
    {
        return $this->role;
    }

    public function getRoleId(): ?string
    {
        return $this->role_id;
    }

    public function isSuperUser(): bool
    {
        return $this->is_superuser;
    }
}
