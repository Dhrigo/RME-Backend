<?php

namespace Modules\MedicalRecordPhysicalAssessment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordPhysicalAssessment\Models\PhysicalAssessment;

class PhysicalAssessmentFactory extends Factory
{
    protected $model = PhysicalAssessment::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'mobility_status' => 'Independent',
            'adl_status' => 'Independent',
            'cognitive_status' => 'Alert and oriented',
            'nutritional_risk' => 'low',
            'pain_level' => 2,
            'notes' => null,
            'assessed_at' => now(),
        ];
    }
}
