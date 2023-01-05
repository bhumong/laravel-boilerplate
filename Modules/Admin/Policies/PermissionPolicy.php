<?php

namespace Modules\Admin\Policies;

use App\Utilities\Enum\PermissionTypeEnum;
use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Admin\Entities\User;
use Modules\Admin\Services\Rbac\Rbac;
use Illuminate\Auth\Access\Response;
use Modules\Admin\Utilities\Enum\PermissionSlugEnum;

class PermissionPolicy
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
                PermissionSlugEnum::adminPermissionIndex->value,
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
                PermissionSlugEnum::adminPermissionGet->value,
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
        return $this->deny(__('Only dev can create new permission.'));
    }

    public function update(User $user, $target): Response
    {
        $can = $this->rbac->can(
            $user,
            $this->rbac->findByPermissionAndType(
                PermissionSlugEnum::adminPermissionUpdate->value,
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
                PermissionSlugEnum::adminPermissionDelete->value,
                PermissionTypeEnum::slug
            )
        );
        if ($can) {
            return $this->allow();
        }
        return $this->deny();
    }

    public function generate(User $user): Response
    {
        $can = $this->rbac->can(
            $user,
            $this->rbac->findByPermissionAndType(
                PermissionSlugEnum::adminPermissionGenerate->value,
                PermissionTypeEnum::slug
            )
        );
        if ($can) {
            return $this->allow();
        }
        return $this->deny();
    }
}
