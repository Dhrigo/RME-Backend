<?php

namespace Modules\MedicalRecordRehabilitationProcedureExamination\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordRehabilitationProcedureExamination\Models\RehabilitationProcedureExamination;

class RehabilitationProcedureExaminationFactory extends Factory
{
    protected $model = RehabilitationProcedureExamination::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'procedure_name' => 'Passive range of motion exercise',
            'therapist_id' => 1,
            'diagnosis_summary' => 'Post-stroke hemiparesis',
            'functional_goal' => 'Improve limb mobility',
            'notes' => null,
            'examined_at' => now(),
        ];
    }
}
