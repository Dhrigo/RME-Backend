<?php

namespace Modules\PembayaranDoctorDiscount\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PembayaranDiscount\Models\Discount;
use Modules\PembayaranDoctorDiscount\Models\DoctorDiscount;

class DoctorDiscountFactory extends Factory
{
    protected $model = DoctorDiscount::class;

    public function definition(): array
    {
        return [
            'discount_id' => Discount::factory(),
            'employee_id' => Employee::factory(),
            'percentage' => fake()->randomFloat(2, 1, 50),
        ];
    }
}
