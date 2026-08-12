<?php

namespace Modules\GeneralLabGroup\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralLabGroup\Models\LabGroup;

class LabGroupFactory extends Factory
{
    protected $model = LabGroup::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'code' => fake()->unique()->lexify('???'),
            'is_active' => true,
        ];
    }
}
