<?php

namespace Modules\MedicalRecordGraceRiskScoreAssessment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordGraceRiskScoreAssessment\Models\GraceRiskScoreAssessment;

class GraceRiskScoreAssessmentFactory extends Factory
{
    protected $model = GraceRiskScoreAssessment::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'age' => 65,
            'heart_rate' => 88,
            'systolic_bp' => 130,
            'creatinine_mg_dl' => 1.10,
            'cardiac_arrest_at_admission' => false,
            'st_segment_deviation' => true,
            'elevated_cardiac_enzymes' => true,
            'killip_class' => 1,
            'total_score' => 140,
            'risk_category' => 'intermediate',
            'assessed_at' => now(),
        ];
    }
}
