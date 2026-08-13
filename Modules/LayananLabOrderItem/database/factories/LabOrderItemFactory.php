<?php

namespace Modules\LayananLabOrderItem\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\LayananLabOrderItem\Models\LabOrderItem;

class LabOrderItemFactory extends Factory
{
    protected $model = LabOrderItem::class;

    public function definition(): array
    {
        return [
            'lab_order_id' => \Modules\LayananLabOrder\Models\LabOrder::factory(),
            'examination_name' => fake()->words(3, true),
            'item_id' => \Modules\InventoryItem\Models\Item::factory(),
            'price' => fake()->randomFloat(2, 1, 100),
        ];
    }
}
