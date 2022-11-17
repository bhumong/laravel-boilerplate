<?php

namespace Database\Factories;

use App\Utilities\Enum\PermissionTypeEnum;
use Arr;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Permission>
 */
class PermissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id' => Str::uuid()->toString(),
            'title' => Str::random(),
            'value' => Str::random(),
            'description' => Str::random(),
            'type' => PermissionTypeEnum::random(),
            'is_active' => Arr::random([true, false]),
        ];
    }
}
