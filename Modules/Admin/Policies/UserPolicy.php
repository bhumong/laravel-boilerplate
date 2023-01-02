<?php

namespace Modules\Admin\Policies;

use App\Utilities\Enum\PermissionTypeEnum;
use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Admin\Entities\User;
use Modules\Admin\Repositories\PermissionRepository;
use Modules\Admin\Services\Rbac\Rbac;
use Illuminate\Auth\Access\Response;
use Modules\Admin\Utilities\Enum\PermissionSlugEnum;

class UserPolicy
{
    use HandlesAuthorization;

    private $rbac;
    private $permissionRepository;

    public function __construct(Rbac $rbac, PermissionRepository $permissionRepository)
    {
        $this->rbac = $rbac;
        $this->permissionRepository = $permissionRepository;
    }

    public function index(User $user): Response
    {
        $can = $this->rbac->can(
            $user,
            $this->rbac->findByPermissionAndType(
                PermissionSlugEnum::adminUserIndex->value,
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
                PermissionSlugEnum::adminUserGet->value,
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
                PermissionSlugEnum::adminUserCreate->value,
                PermissionTypeEnum::slug
            )
        );
        if ($can) {
            return $this->allow();
        }
        return $this->deny();
    }

    public function update(User $user,  $target): Response
    {
        $can = $this->rbac->can(
            $user,
            $this->rbac->findByPermissionAndType(
                PermissionSlugEnum::adminUserUpdate->value,
                PermissionTypeEnum::slug
            )
        );
        if ($can) {
            return $this->allow();
        }
        return $this->deny();
    }

    public function delete(User $user,  $target): Response
    {
        $can = $this->rbac->can(
            $user,
            $this->rbac->findByPermissionAndType(
                PermissionSlugEnum::adminUserDelete->value,
                PermissionTypeEnum::slug
            )
        );
        if ($can) {
            return $this->allow();
        }
        return $this->deny();
    }
}
