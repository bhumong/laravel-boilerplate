<?php

namespace Modules\Admin\Repositories;

use App\Models\Permission;
use App\Utilities\DT\DataTable;
use App\Utilities\Helper\QueryHelper;
use App\Utilities\Interface\DataTableSourceInterface;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;

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
            $query->where('title', 'like', "${search}");
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
            'title', 'is_active', 'description'
        ])->toArray();
        $role->updateOrFail($data);
        return $role;
    }
}
