<?php

namespace Modules\LayananLabSensitivityResult\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\LayananLabSensitivityResult\Models\LabSensitivityResult;

class LabSensitivityResultFactory extends Factory
{
    protected $model = LabSensitivityResult::class;

    public function definition(): array
    {
        return [
            'lab_order_id' => \Modules\LayananLabOrder\Models\LabOrder::factory(),
            'organism' => fake()->words(3, true),
            'antibiotic_name' => fake()->words(3, true),
            'sensitivity_result' => fake()->randomElement(['sensitive', 'intermediate', 'resistant']),
            'examined_at' => fake()->dateTimeBetween('-1 month', 'now')->format('Y-m-d H:i:s'),
        ];
    }
}
