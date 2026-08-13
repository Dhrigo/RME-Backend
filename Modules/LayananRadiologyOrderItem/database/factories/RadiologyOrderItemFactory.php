<?php

namespace Modules\LayananRadiologyOrderItem\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\LayananRadiologyOrderItem\Models\RadiologyOrderItem;

class RadiologyOrderItemFactory extends Factory
{
    protected $model = RadiologyOrderItem::class;

    public function definition(): array
    {
        return [
            'radiology_order_id' => \Modules\LayananRadiologyOrder\Models\RadiologyOrder::factory(),
            'examination_name' => fake()->words(3, true),
            'body_part' => fake()->words(3, true),
            'price' => fake()->randomFloat(2, 1, 100),
        ];
    }
}
