<?php

namespace Modules\PembayaranDiscount\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PembayaranDiscount\Models\Discount;

class DiscountFactory extends Factory
{
    protected $model = Discount::class;

    public function definition(): array
    {
        $type = fake()->randomElement(Discount::DISCOUNT_TYPES);

        return [
            'code' => fake()->unique()->lexify('DISC-???'),
            'name' => fake()->words(2, true),
            'discount_type' => $type,
            'value' => $type === 'percentage' ? fake()->numberBetween(1, 100) : fake()->numberBetween(1000, 500000),
            'is_active' => true,
        ];
    }
}
