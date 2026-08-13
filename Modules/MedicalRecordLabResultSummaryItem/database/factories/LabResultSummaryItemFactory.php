<?php

namespace Modules\MedicalRecordLabResultSummaryItem\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordLabResultSummaryItem\Models\LabResultSummaryItem;

class LabResultSummaryItemFactory extends Factory
{
    protected $model = LabResultSummaryItem::class;

    public function definition(): array
    {
        return [
            'summary_id' => \Modules\MedicalRecordLabResultSummary\Models\LabResultSummary::factory(),
            'lab_test_name' => fake()->randomElement(['Hemoglobin','Leukosit','Trombosit','Kreatinin','SGOT']),
            'result_value' => (string) fake()->randomFloat(1,1,200),
            'unit' => fake()->randomElement(['g/dL','mg/dL','/uL']),
            'reference_range' => '10-20',
            'flag' => 'normal',
            'tested_at' => now(),
        ];
    }
}
