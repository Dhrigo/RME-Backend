<?php

namespace Modules\MedicalRecordCaseManagerAssessment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordCaseManagerAssessment\Models\CaseManagerAssessment;

class CaseManagerAssessmentFactory extends Factory
{
    protected $model = CaseManagerAssessment::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'case_manager_id' => 1,
            'screening_criteria' => 'Length of stay > 5 days, complex discharge needs',
            'risk_level' => 'medium',
            'care_plan' => 'Coordinate with social worker for discharge planning',
            'follow_up_needed' => true,
            'assessed_at' => now(),
        ];
    }
}
