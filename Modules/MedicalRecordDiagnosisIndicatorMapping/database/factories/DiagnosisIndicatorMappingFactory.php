<?php

namespace Modules\MedicalRecordDiagnosisIndicatorMapping\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordDiagnosisIndicatorMapping\Models\DiagnosisIndicatorMapping;

class DiagnosisIndicatorMappingFactory extends Factory
{
    protected $model = DiagnosisIndicatorMapping::class;

    public function definition(): array
    {
        return [
            'diagnosis_id' => 1,
            'indicator_code' => 'IND-' . $this->faker->unique()->randomNumber(4),
            'indicator_name' => $this->faker->words(3, true),
            'target_score' => '5',
            'description' => $this->faker->sentence(),
            'is_active' => true,
        ];
    }
}
