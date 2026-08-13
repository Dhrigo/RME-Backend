<?php

namespace Modules\MedicalRecordEpfraAssessment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordEpfraAssessment\Models\EpfraAssessment;

class EpfraAssessmentFactory extends Factory
{
    protected $model = EpfraAssessment::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'assessor_id' => 1,
            'criteria_notes' => 'Elderly patient functional risk screening',
            'score' => 4,
            'risk_level' => 'medium',
            'assessed_at' => now(),
        ];
    }
}
