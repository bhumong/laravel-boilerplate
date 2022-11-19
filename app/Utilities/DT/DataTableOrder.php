<?php

namespace App\Utilities\DT;

use App\Utilities\DataStructure;

class DataTableOrder extends DataStructure
{
    /** @var integer */
    public $column;
    /** @var boolean */
    public $dir;

    public function __construct(array $attributes = [])
    {
        $attributes['column'] = (int) $attributes['column'];
        $attributes['dir'] = (($attributes['dir'] ?? 'asc') === 'asc') ? 'asc' : 'desc';
        parent::__construct($attributes);
    }
}
