<?php

namespace Modules\PembayaranCashier\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PembayaranCashier\Models\Cashier;

class CashierFactory extends Factory
{
    protected $model = Cashier::class;

    public function definition(): array
    {
        return [
            'employee_id' => Employee::factory(),
            'cashier_code' => fake()->unique()->numerify('KSR-####'),
            'shift' => fake()->randomElement(['pagi', 'siang', 'malam']),
            'is_active' => true,
        ];
    }
}
