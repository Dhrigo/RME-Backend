<?php

namespace Modules\InventoryItemClassification\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\InventoryItemClassification\Models\ItemClassification;

class ItemClassificationFactory extends Factory
{
    protected $model = ItemClassification::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'code' => fake()->unique()->lexify('???'),
            'is_active' => true,
        ];
    }
}
