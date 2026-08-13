<?php

namespace Modules\MedicalRecordGetUpAndGoTestAssessment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordGetUpAndGoTestAssessment\Models\GetUpAndGoTestAssessment;

class GetUpAndGoTestAssessmentFactory extends Factory
{
    protected $model = GetUpAndGoTestAssessment::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'time_seconds' => 11.5,
            'assistive_device' => 'None',
            'fall_risk' => 'low',
            'notes' => null,
            'assessed_at' => now(),
        ];
    }
}
