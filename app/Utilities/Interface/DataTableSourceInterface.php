<?php

namespace App\Utilities\Interface;

use App\Utilities\DT\DataTable;
use Illuminate\Support\Collection;

interface DataTableSourceInterface
{
    public function countRecordsTotal(): int;
    public function countRecordsFiltered(DataTable $dataTable): int;
    public function findRecordsFiltered(DataTable $dataTable, int $limit, int $offset): Collection;
}
