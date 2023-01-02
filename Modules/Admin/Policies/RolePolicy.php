<?php

namespace Modules\Admin\Policies;

use App\Utilities\Enum\PermissionTypeEnum;
use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Admin\Entities\User;
use Modules\Admin\Services\Rbac\Rbac;
use Illuminate\Auth\Access\Response;
use Modules\Admin\Utilities\Enum\PermissionSlugEnum;

class RolePolicy
{
    use HandlesAuthorization;

    private $rbac;

    public function __construct(Rbac $rbac)
    {
        $this->rbac = $rbac;
    }

    public function index(User $user): Response
    {
        $can = $this->rbac->can(
            $user,
            $this->rbac->findByPermissionAndType(
                PermissionSlugEnum::adminRoleIndex->value,
                PermissionTypeEnum::slug
            )
        );
        if ($can) {
            return $this->allow();
        }
        return $this->deny();
    }

    public function get(User $user, $target): Response
    {
        $can = $this->rbac->can(
            $user,
            $this->rbac->findByPermissionAndType(
                PermissionSlugEnum::adminRoleGet->value,
                PermissionTypeEnum::slug
            )
        );
        if ($can) {
            return $this->allow();
        }
        return $this->deny();
    }

    public function create(User $user): Response
    {
        $can = $this->rbac->can(
            $user,
            $this->rbac->findByPermissionAndType(
                PermissionSlugEnum::adminRoleCreate->value,
                PermissionTypeEnum::slug
            )
        );
        if ($can) {
            return $this->allow();
        }
        return $this->deny();
    }

    public function update(User $user, $target): Response
    {
        $can = $this->rbac->can(
            $user,
            $this->rbac->findByPermissionAndType(
                PermissionSlugEnum::adminRoleUpdate->value,
                PermissionTypeEnum::slug
            )
        );
        if ($can) {
            return $this->allow();
        }
        return $this->deny();
    }

    public function delete(User $user, $target): Response
    {
        $can = $this->rbac->can(
            $user,
            $this->rbac->findByPermissionAndType(
                PermissionSlugEnum::adminRoleDelete->value,
                PermissionTypeEnum::slug
            )
        );
        if ($can) {
            return $this->allow();
        }
        return $this->deny();
    }

    public function applyChange(User $user): Response
    {
        $can = $this->rbac->can(
            $user,
            $this->rbac->findByPermissionAndType(
                PermissionSlugEnum::adminRoleDelete->value,
                PermissionTypeEnum::slug
            )
        );
        if ($can) {
            return $this->allow();
        }
        return $this->deny();
    }
}
