<?php

namespace Modules\MedicalRecordPressureUlcerRiskAssessment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordPressureUlcerRiskAssessment\Models\PressureUlcerRiskAssessment;

class PressureUlcerRiskAssessmentFactory extends Factory
{
    protected $model = PressureUlcerRiskAssessment::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'sensory_perception' => 3,
            'moisture' => 3,
            'activity' => 3,
            'mobility' => 3,
            'nutrition' => 3,
            'friction_shear' => 2,
            'total_score' => 17,
            'risk_level' => 'mild_risk',
            'assessed_at' => now(),
        ];
    }
}
