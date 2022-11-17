<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;

trait CompositePrimaryKey
{
    protected function setKeysForSaveQuery(Builder $query)
    {
        foreach ($this->compositePrimaryKeys as $key) {
            $query->where($key, '=', $this->getOriginal($key));
        }
        return $query;
    }
}
