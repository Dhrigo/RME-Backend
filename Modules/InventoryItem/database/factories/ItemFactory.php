<?php

namespace Modules\InventoryItem\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\InventoryItem\Models\Item;

class ItemFactory extends Factory
{
    protected $model = Item::class;

    public function definition(): array
    {
        $buyPrice = fake()->randomFloat(2, 500, 50000);

        return [
            'code' => fake()->unique()->bothify('ITM-#####'),
            'name' => fake()->unique()->words(2, true),
            'category' => fake()->randomElement(['medicine', 'medical-supply', 'equipment']),
            'unit' => fake()->randomElement(['tablet', 'botol', 'strip', 'pcs']),
            'brand' => null,
            'is_generic' => false,
            'is_formulary' => true,
            'buy_price' => $buyPrice,
            'sell_price' => $buyPrice * 1.2,
            'stock_quantity' => fake()->numberBetween(0, 500),
            'is_active' => true,
        ];
    }
}
