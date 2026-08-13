<?php

namespace Modules\PenjualanSale\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PenjualanSale\Models\Sale;

class SaleFactory extends Factory
{
    protected $model = Sale::class;

    public function definition(): array
    {
        return [
            'sale_number' => fake()->unique()->numerify('SAL-##########'),
            'patient_id' => null,
            'sold_by' => Employee::factory(),
            'sold_at' => now(),
            'total_amount' => fake()->randomFloat(2, 10000, 500000),
            'status' => 'completed',
        ];
    }
}
