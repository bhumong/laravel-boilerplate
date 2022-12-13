<?php

namespace App\Console\Commands\DevOnly;

use Barryvdh\LaravelIdeHelper\Console\ModelsCommand as BaseModelsCommand;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Relations\Relation;

class ModelsCommand extends BaseModelsCommand
{
    /**
     * @param  string   $relation
     * @param  Relation $relationObj
     * @return bool
     */
    protected function isRelationNullable(string $relation, Relation $relationObj): bool
    {
        $reflectionObj = new \ReflectionObject($relationObj);

        if (in_array($relation, ['hasOne', 'hasOneThrough', 'morphOne'], true) || !$reflectionObj->hasProperty('foreignKey')) {
            return parent::isRelationNullable($relation, $relationObj);
        }

        $fkProp = $reflectionObj->getProperty('foreignKey');
        $fkProp->setAccessible(true);

        return (bool)Arr::first(
            (array)$fkProp->getValue($relationObj),
            function (string $value) {
                return isset($this->nullableColumns[$value]);
            }
        );
    }
}
