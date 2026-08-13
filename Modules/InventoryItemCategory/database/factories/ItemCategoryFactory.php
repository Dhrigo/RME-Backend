<?php

namespace Modules\InventoryItemCategory\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\InventoryItemCategory\Models\ItemCategory;

class ItemCategoryFactory extends Factory
{
    protected $model = ItemCategory::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'code' => fake()->unique()->lexify('???'),
            'is_active' => true,
        ];
    }
}
