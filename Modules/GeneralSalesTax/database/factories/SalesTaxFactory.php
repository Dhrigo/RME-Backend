<?php

namespace Modules\GeneralSalesTax\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralSalesTax\Models\SalesTax;

class SalesTaxFactory extends Factory
{
    protected $model = SalesTax::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->words(2, true),
            'rate' => fake()->randomElement([11.00, 10.00, 12.00]),
            'effective_date' => fake()->date(),
            'is_active' => true,
        ];
    }
}
