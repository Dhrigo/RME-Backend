<?php

namespace Modules\MedicalRecordEmgExamination\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordEmgExamination\Models\EmgExamination;

class EmgExaminationFactory extends Factory
{
    protected $model = EmgExamination::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'patient_id' => 1,
            'nerve_conduction_velocity' => 55.0,
            'spontaneous_activity' => 'None',
            'motor_unit_potentials' => 'Normal amplitude and duration',
            'recruitment_pattern' => 'Full recruitment',
            'conclusion' => 'Normal electrodiagnostic study',
            'examined_at' => now(),
        ];
    }
}
