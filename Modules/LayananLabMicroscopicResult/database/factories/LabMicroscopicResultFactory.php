<?php

namespace Modules\LayananLabMicroscopicResult\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\LayananLabMicroscopicResult\Models\LabMicroscopicResult;

class LabMicroscopicResultFactory extends Factory
{
    protected $model = LabMicroscopicResult::class;

    public function definition(): array
    {
        return [
            'lab_order_id' => \Modules\LayananLabOrder\Models\LabOrder::factory(),
            'specimen_type' => fake()->words(3, true),
            'findings' => fake()->paragraph(),
            'examined_by' => \Modules\GeneralEmployee\Models\Employee::factory(),
            'examined_at' => fake()->dateTimeBetween('-1 month', 'now')->format('Y-m-d H:i:s'),
        ];
    }
}
