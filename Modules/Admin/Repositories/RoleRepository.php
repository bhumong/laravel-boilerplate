<?php

namespace Modules\Admin\Repositories;

use App\Utilities\DT\DataTable;
use App\Utilities\Helper\QueryHelper;
use App\Utilities\Interface\DataTableSourceInterface;
use Arr;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Modules\Admin\Entities\Role;

class RoleRepository implements DataTableSourceInterface
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

    public function countRecordsTotal(): int
    {
        return Role::count();
    }

    public function countRecordsFiltered(DataTable $dataTable): int
    {
        return $this->queryFilter($dataTable)->count();
    }

    public function findRecordsFiltered(DataTable $dataTable, int $limit, int $offset): Collection
    {
        $query = $this->queryFilter($dataTable);
        $this->orderBy($query, $dataTable);
        return $query->limit($limit)->offset($offset)->get();
    }

    private function queryFilter(DataTable $dataTable)
    {
        $roleQuery = Role::query();
        $this->filterTitle($roleQuery, $dataTable);
        return $roleQuery;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param DataTable $dataTable
     * @return void
     */
    private function filterTitle($query, DataTable $dataTable)
    {
        $search = $dataTable->search->value;
        if ($search) {
            $query->where('title', 'like', "%${search}%");
        }
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param DataTable $dataTable
     * @return void
     */
    private function orderBy($query, DataTable $dataTable)
    {
        $order = $dataTable->order[0];
        $column = $dataTable->columns[$order->column];
        $sortColumn = match ($column->data) {
            'is_active' => 'is_active',
            'created_at' => 'created_at',
            default => 'title',
        };
        $query->orderBy($sortColumn, $order->dir);
    }

    public function update(Role $role, array $data)
    {
        $data = collect($data)->only([
            'title', 'is_active', 'description', 'permission_ids'
        ])->toArray();
        $permissionIds = Arr::pull($data, 'permission_ids');
        $data['updated_at'] = now();
        $role->updateOrFail($data);
        $role->permissions()->sync($permissionIds);
        return $role;
    }

    public function create(array $data)
    {
        $data = collect($data)->only([
            'title', 'is_active', 'description', 'permission_ids'
        ])->toArray();
        $permissionIds = Arr::pull($data, 'permission_ids');
        $data['created_at'] = now();
        $role = new Role($data);
        $role->saveOrFail();
        $role->permissions()->sync($permissionIds);
        return $role;
    }

    public function delete(Role $role)
    {
        $role->deleteOrFail();
    }

    public function toggleActive(Role $role)
    {
        if ($role->is_active) {
            $role->is_active = 0;
        } else {
            $role->is_active = 1;
        }
        $role->saveOrFail();
    }
}
