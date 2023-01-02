<?php

namespace Modules\Admin\Repositories;

use App\Utilities\DT\DataTable;
use App\Utilities\Enum\PermissionTypeEnum;
use App\Utilities\Helper\QueryHelper;
use App\Utilities\Interface\DataTableSourceInterface;
use Illuminate\Support\Collection;
use Modules\Admin\Entities\Permission;

class PermissionRepository implements DataTableSourceInterface
{

    public function countRecordsTotal(): int
    {
        return Permission::count();
    }

    public function countRecordsFiltered(DataTable $dataTable): int
    {
        return $this->queryFilter($dataTable)->count();
    }

    private function queryFilter(DataTable $dataTable)
    {
        $permissionQuery = Permission::query();
        $this->filterPermission($permissionQuery, $dataTable);
        $this->filterRoles($permissionQuery, $dataTable);
        return $permissionQuery;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param DataTable $dataTable
     * @return void
     */
    private function filterPermission($query, DataTable $dataTable)
    {
        $search = $dataTable->search->value;
        if ($search) {
            $query->where('permission', 'like', "%${search}%");
        }
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param DataTable $dataTable
     * @return void
     */
    private function filterRoles($query, DataTable $dataTable)
    {
        $search = $dataTable->getColumnSearchValue('roles');
        if ($search) {
            $query->whereHas('roles', function ($inQuery) use ($search) {
                $inQuery->where('id', $search);
            });
        }
    }

    public function findRecordsFiltered(DataTable $dataTable, int $limit, int $offset): Collection
    {
        $query = $this->queryFilter($dataTable);
        $this->orderBy($query, $dataTable);
        return $query->limit($limit)->offset($offset)->get();
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
            default => 'permission',
        };
        $query->orderBy($sortColumn, $order->dir);
    }

    public function update(Permission $permission, array $data)
    {
        $data = collect($data)->only([
            'permission', 'is_active', 'description'
        ])->toArray();
        $data['updated_at'] = now();
        $permission->updateOrFail($data);
        return $permission;
    }

    public function create(array $data)
    {
        $data = collect($data)->only([
            'permission', 'is_active', 'description', 'type'
        ])->toArray();
        $data['created_at'] = now();
        $permission = new Permission($data);
        $permission->saveOrFail();
        return $permission;
    }

    public function delete(Permission $permission)
    {
        $permission->deleteOrFail();
    }

    public function autocomplete(string $name = '')
    {
        $query = Permission::query()->select('permission', 'id');
        if ($name) {
            QueryHelper::searchColumns($query, ['permission'], QueryHelper::tokenizeKeywords($name));
        }
        $query->where('is_active', true)
            ->limit(100);

        return $query->get()->map(function (Permission $permission) {
            return [
                'id' => $permission->id,
                'text' => $permission->permission
            ];
        });
    }

    public function insert($values)
    {
        return Permission::insert($values);
    }

    public function existsByPermissionAndType($permission, PermissionTypeEnum $type)
    {
        return Permission::query()
            ->where('permission', $permission)
            ->where('type', $type->value)
            ->exists();
    }

    public function getBySlug(PermissionTypeEnum $type)
    {
        return Permission::query()
            ->where('type', $type->value)
            ->get();
    }
}
