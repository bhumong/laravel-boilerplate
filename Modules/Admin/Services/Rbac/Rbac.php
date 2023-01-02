<?php

namespace Modules\Admin\Services\Rbac;

use App\Utilities\Enum\PermissionTypeEnum;
use App\Utilities\Enum\TimeEnum;
use Cache;
use Illuminate\Support\Collection;
use Modules\Admin\Entities\Permission;
use Modules\Admin\Entities\Role;
use Modules\Admin\Repositories\RoleRepository;

class Rbac
{
    /**
     * @var Collection
     */
    protected $roles;
    protected $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->roles = collect([]);
    }

    /**
     * @param Role[]|Collection $roles
     */
    public function setRoles($roles)
    {
        $this->roles = $roles instanceof Collection ? $roles : collect($roles);
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function generate()
    {
        $roles = Cache::remember('rbac_roles', TimeEnum::oneDayInSecond->value, function () {
            return $this->roleRepository->all(['permissions']);
        });

        $this->setRoles($roles);
    }

    public function clearCache()
    {
        Cache::forget('rbac_roles');
    }

    public function cache()
    {
        $this->clearCache();
        $this->generate();
    }

    /**
     * @param RbacUserInterface $user
     * @param Permission|string $permission
     * @return bool
     */
    public function can(RbacUserInterface $user, $permission): bool
    {
        if ($user->isSuperUser()) {
            return true;
        }
        /** @var Role|null */
        $role = $this->roles->where('id', $user->getRoleId())->first();
        if (!$role) {
            return false;
        }
        $permissionId = $permission instanceof Permission ? $permission->getKey() : $permission;
        /** @var Permission|null */
        $permission = $role->permissions->where('id', $permissionId)->first();
        if (!$permission) {
            return false;
        }
        return $permission->is_active == true ? true : false;
    }

    /**
     * @param RbacUserInterface $user
     * @param Permission[]|string[]|Collection $permissions
     * @return bool
     */
    public function canAny(RbacUserInterface $user, iterable $permissions)
    {
        foreach ($permissions as &$permission) {
            if ($this->can($user, $permission)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param RbacUserInterface $user
     * @param Role|string $role
     * @return bool
     */
    public function is(RbacUserInterface $user, $role): bool
    {
        $roleId = $role instanceof Role ? $role->getKey() : $role;
        return $user->getRoleId() === $roleId;
    }

    /**
     * @param RbacUserInterface $user
     * @param Role[]|string[]|Collection $roles
     * @return bool
     */
    public function isAny(RbacUserInterface $user, iterable $roles): bool
    {
        foreach ($roles as &$role) {
            $roleId = $role instanceof Role ? $role->getKey() : $role;
            if ($user->getRoleId() === $roleId) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param string permission
     * @param PermissionTypeEnum $type
     * @return Permission|null
     */
    public function findByPermissionAndType(string $permission, PermissionTypeEnum $type)
    {
        /** @var Collection */
        $permissions = $this->roles->pluck('permissions')->flatten();
        if ($permissions instanceof Collection) {
            return $permissions
                ->where('permission', $permission)
                ->where('type', $type->name)
                ->first();
        }
        return null;
    }
}
