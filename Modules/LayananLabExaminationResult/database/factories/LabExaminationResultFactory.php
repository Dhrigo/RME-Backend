<?php

namespace Modules\LayananLabExaminationResult\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\LayananLabExaminationResult\Models\LabExaminationResult;

class LabExaminationResultFactory extends Factory
{
    protected $model = LabExaminationResult::class;

    public function definition(): array
    {
        return [
            'lab_order_id' => \Modules\LayananLabOrder\Models\LabOrder::factory(),
            'parameter_name' => fake()->words(3, true),
            'result_value' => fake()->words(3, true),
            'unit' => fake()->words(3, true),
            'reference_range' => fake()->words(3, true),
            'is_abnormal' => false,
            'examined_at' => fake()->dateTimeBetween('-1 month', 'now')->format('Y-m-d H:i:s'),
        ];
    }
}
