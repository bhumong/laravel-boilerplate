<?php

namespace Modules\Admin\Services\Rbac;

use App\Models\Role;

interface RbacUserInterface
{
    public function getRole(): Role;
    public function getRoleId(): ?string;
    public function isSuperUser(): bool;
}
