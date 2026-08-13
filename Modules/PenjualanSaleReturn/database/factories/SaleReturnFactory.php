<?php

namespace Modules\PenjualanSaleReturn\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PenjualanSale\Models\Sale;
use Modules\PenjualanSaleReturn\Models\SaleReturn;

class SaleReturnFactory extends Factory
{
    protected $model = SaleReturn::class;

    public function definition(): array
    {
        return [
            'sale_id' => Sale::factory(),
            'returned_at' => now(),
            'reason' => fake()->sentence(6),
            'refund_amount' => fake()->randomFloat(2, 5000, 100000),
        ];
    }
}
