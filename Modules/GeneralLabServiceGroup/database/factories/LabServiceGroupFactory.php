<?php

namespace Modules\GeneralLabServiceGroup\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralLabServiceGroup\Models\LabServiceGroup;

class LabServiceGroupFactory extends Factory
{
    protected $model = LabServiceGroup::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'code' => fake()->unique()->lexify('???'),
            'is_active' => true,
        ];
    }
}
