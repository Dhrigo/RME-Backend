<?php

namespace Modules\InventoryUnitOfMeasure\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\InventoryUnitOfMeasure\Models\UnitOfMeasure;

class UnitOfMeasureFactory extends Factory
{
    protected $model = UnitOfMeasure::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'code' => fake()->unique()->lexify('???'),
            'abbreviation' => fake()->unique()->lexify('??'),
            'is_active' => true,
        ];
    }
}
