<?php

namespace Modules\Admin\Repositories;

use App\Utilities\DT\DataTable;
use App\Utilities\Helper\QueryHelper;
use App\Utilities\Interface\DataTableSourceInterface;
use Hash;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Modules\Admin\Entities\User;

class UserRepository implements DataTableSourceInterface
{
    public function countRecordsTotal(): int
    {
        return User::count();
    }

    private function orderBy($query, DataTable $dataTable)
    {
        $order = $dataTable->order[0];
        $column = $dataTable->columns[$order->column];
        switch ($column->data) {
            case 'email':
                $sortColumn = 'email';
                break;
            case 'name':
            default:
                $sortColumn = 'name';
                break;
        }
        $query->orderBy($sortColumn, $order->dir);
    }

    public function countRecordsFiltered(DataTable $dataTable): int
    {
        return $this->queryRecordsFiltered($dataTable)->count();
    }

    public function findRecordsFiltered(DataTable $dataTable, int $limit, int $offset): Collection
    {
        $query = $this->queryRecordsFiltered($dataTable);
        $query->with('role');
        $this->orderBy($query, $dataTable);
        return $query->limit($limit)->offset($offset)->get();
    }

    private function filterUser($query, DataTable $dataTable)
    {
        $keywords = array_filter(array_map('trim', explode(' ', trim($dataTable->search->value))));
        if (count($keywords)) {
            $searchColumns = ['name', 'email'];
            foreach ($searchColumns as $col) {
                $query->orWhere(function ($query) use (&$keywords, &$col) {
                    foreach ($keywords as $keyword) {
                        $query->where($col, 'like', "%{$keyword}%");
                    }
                });
            }
        }

        $filters = array_column($dataTable->columns, 'search', 'data');

        if (!empty($filters['role']->value)) {
            $query->where('role', $filters['role']->value);
        }
    }

    private function queryRecordsFiltered(DataTable $dataTable)
    {
        $userQuery = User::query();
        $this->filterUser($userQuery, $dataTable);
        return $userQuery;
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update(User $user, array $data)
    {
        $data = collect($data)->only([
            'name', 'email', 'is_superuser', 'role_id', 'password'
        ])->toArray();
        $this->setPassword($data);
        $user->updateOrFail($data);
        return $user;
    }

    public function insert(array $data)
    {
        $data = collect($data)->only([
            'name', 'email', 'is_superuser', 'role_id', 'password'
        ])->toArray();
        $this->setPassword($data);
        $user = new User($data);
        $user->saveOrFail();
        return $user;
    }


    public function autocomplete(string $search = '')
    {
        $searches = QueryHelper::tokenizeKeywords($search);

        $query = User::query()
            ->selectRaw("
                id,
                name as `combine`
            ")
            ->where(function ($inQuery) use ($searches) {
                QueryHelper::searchJoinedColumns($inQuery, ['name'], $searches);
            });

        $users = $query->limit(10)
            ->get();

        $users = $users
            ->pluck('id', 'combine');
        return $users;
    }

    public function detete(User $user)
    {
        $user->deleteOrFail();
    }

    private function setPassword(&$data) 
    {
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
    }
}
