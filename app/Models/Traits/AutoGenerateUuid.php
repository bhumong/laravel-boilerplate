<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;

trait AutoGenerateUuid
{
    // boot method should be auto called for Eloquent::bootTraits
    protected static function bootAutoGenerateUuid()
    {
        // on model creating
        static::creating(function ($model) {
            // if model PK is empty
            if ($model->getKey() === null) {
                // assign ordered uuid as pk
                // (ordered for better index performance)
                $model->{$model->getKeyName()} = (string) Str::orderedUuid();
            }
        });
    }

    public function getKeyType()
    {
        return 'string';
    }
    public function getIncrementing()
    {
        return false;
    }
}
