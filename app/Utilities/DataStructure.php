<?php

namespace App\Utilities;

use App\Exceptions\ApiException;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use JsonSerializable;

abstract class DataStructure implements Arrayable, Jsonable, JsonSerializable
{
    public function __construct(array $attributes = [])
    {
        $this->fill($attributes);
    }

    public function fill(array $attributes = [])
    {
        foreach ($attributes as $key => $value) {
            $this->$key = $value;
        }
    }

    public function __get($name)
    {
        throw new ApiException(500, "Getting undeclared attribute [{$name}] in " . static::class);
    }

    public function __set($name, $value)
    {
        throw new ApiException(500, "Setting undeclared attribute [{$name}] in " . static::class);
    }

    public function toArray()
    {
        return array_map(function ($value) {
            return $value instanceof Arrayable ? $value->toArray() : $value;
        }, get_object_vars($this));
    }

    public function toJson($options = 0)
    {
        return json_encode($this->jsonSerialize(), $options);
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
