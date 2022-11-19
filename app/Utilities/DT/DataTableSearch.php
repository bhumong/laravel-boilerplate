<?php

namespace App\Utilities\DT;

use App\Utilities\DataStructure;

class DataTableSearch extends DataStructure
{
    /** @var string */
    public $value;
    /** @var boolean */
    public $regex;

    public function __construct(array $attributes = [])
    {
        $attributes['regex'] = (($attributes['regex'] ?? null) === 'true');
        parent::__construct($attributes);
    }
}
