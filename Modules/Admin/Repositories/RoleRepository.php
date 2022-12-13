<?php

namespace Modules\Admin\Repositories;

use App\Utilities\Helper\QueryHelper;
use Modules\Admin\Entities\Role;

class RoleRepository
{
    public function autocomplete(string $name = '')
    {
        $query = Role::query()->select('title', 'id');
        if ($name) {
            QueryHelper::searchColumns($query, ['title'], QueryHelper::tokenizeKeywords($name));
        }
        $query->where('is_active', true)
            ->limit(10);

        return $query->get()->map(function (Role $role) {
            return [
                'id' => $role->id,
                'text' => $role->title
            ];
        });
    }
}
