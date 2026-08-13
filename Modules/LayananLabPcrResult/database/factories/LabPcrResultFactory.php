<?php

namespace Modules\LayananLabPcrResult\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\LayananLabPcrResult\Models\LabPcrResult;

class LabPcrResultFactory extends Factory
{
    protected $model = LabPcrResult::class;

    public function definition(): array
    {
        return [
            'lab_order_id' => \Modules\LayananLabOrder\Models\LabOrder::factory(),
            'target_gene' => fake()->words(3, true),
            'result' => fake()->randomElement(['detected', 'not_detected', 'inconclusive']),
            'ct_value' => fake()->randomFloat(2, 1, 100),
            'examined_at' => fake()->dateTimeBetween('-1 month', 'now')->format('Y-m-d H:i:s'),
        ];
    }
}
