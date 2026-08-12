<?php

namespace Modules\LayananLabResult\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\LayananLabOrder\Models\LabOrder;
use Modules\LayananLabResult\Models\LabResult;

class LabResultFactory extends Factory
{
    protected $model = LabResult::class;

    public function definition(): array
    {
        return [
            'lab_order_id' => LabOrder::factory(),
            'test_name' => fake()->randomElement(['Hemoglobin', 'Leukosit', 'Trombosit', 'Gula Darah Sewaktu']),
            'result_value' => (string) fake()->randomFloat(1, 3, 15),
            'normal_range' => '12.0 - 16.0',
            'unit' => 'g/dL',
            'is_abnormal' => false,
            'notes' => null,
            'recorded_at' => now(),
            'recorded_by' => null,
            'status' => 'final',
        ];
    }
}
