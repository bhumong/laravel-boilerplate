<?php

namespace App\Http\Resources;

use App\Utilities\DT\DataTable;
use App\Utilities\Interface\DataTableSourceInterface;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DataTableResourceCollection extends ResourceCollection
{
    /** @var DataTableSourceInterface */
    public $resource;

    /**
     * To return dataTable server processing compatible result
     *
     * @param DataTableSourceInterface $resource, a repository to retrieve data and impl. DataTableSourceInterface interface
     * @param string $collects indicates what transformer should be used to render each element in data list
     */
    public function __construct(DataTableSourceInterface $resource, string $collects)
    {
        $this->collects = $collects;
        $this->resource = $resource;
    }

    public function toArray($request)
    {
        $dataTable = new DataTable($request->input());
        $this->collectResource($this->resource->findRecordsFiltered($dataTable, $dataTable->length, $dataTable->start));
        return parent::toArray($request);
    }

    public function with($request)
    {
        $dataTable = new DataTable($request->input());
        return [
            'draw' => $dataTable->draw,
            'recordsTotal' => $this->resource->countRecordsTotal(),
            'recordsFiltered' => $this->resource->countRecordsFiltered($dataTable),
        ];
    }
}
