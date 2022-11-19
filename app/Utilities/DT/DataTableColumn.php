<?php

namespace App\Utilities\DT;

use App\Utilities\DataStructure;

class DataTableColumn extends DataStructure
{
    /** @var string */
    public $data;
    /** @var string */
    public $name;
    /** @var boolean */
    public $searchable;
    /** @var boolean */
    public $orderable;
    /** @var DataTableSearch */
    public $search;

    public function __construct(array $attributes = [])
    {
        $attributes['searchable'] = (($attributes['searchable'] ?? 'true') === 'true');
        $attributes['orderable'] = (($attributes['orderable'] ?? 'true') === 'true');
        $attributes['search'] = new DataTableSearch($attributes['search']);
        parent::__construct($attributes);
    }
}
