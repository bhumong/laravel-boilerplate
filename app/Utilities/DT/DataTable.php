<?php

namespace App\Utilities\DT;

use App\Utilities\DataStructure;

class DataTable extends DataStructure
{
    /** @var integer */
    public $draw;
    /** @var integer */
    public $start;
    /** @var integer */
    public $length;
    /** @var DataTableSearch */
    public $search;
    /** @var DataTableOrder[] */
    public $order;
    /** @var DataTableColumn[] */
    public $columns;

    public function __construct(array $attributes = [])
    {
        $attributes = collect($attributes)->only([
            'draw',
            'start',
            'length',
            'search',
            'order',
            'columns',
        ])->toArray();
        $attributes['draw'] = (int) $attributes['draw'];
        $attributes['start'] = (int) $attributes['start'];
        $attributes['length'] = (int) $attributes['length'];
        $attributes['search'] = new DataTableSearch($attributes['search']);
        $attributes['order'] = collect($attributes['order'])->mapInto(DataTableOrder::class)->all();
        $attributes['columns'] = collect($attributes['columns'])->mapInto(DataTableColumn::class)->all();
        parent::__construct($attributes);
    }

    public function getColumn(string $column): ?DataTableColumn
    {
        $columns = collect($this->columns);
        /** @var DataTableColumn */
        $searchedColumn = $columns->where('data', '=', $column)->first();
        return $searchedColumn;
    }

    public function getColumnSearchValue(string $column)
    {
        $dataTableColumn = $this->getColumn($column);
        return $dataTableColumn->search->value ?? null;
    }
}
