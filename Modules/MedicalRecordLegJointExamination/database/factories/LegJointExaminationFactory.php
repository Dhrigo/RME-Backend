<?php

namespace Modules\MedicalRecordLegJointExamination\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordLegJointExamination\Models\LegJointExamination;

class LegJointExaminationFactory extends Factory
{
    protected $model = LegJointExamination::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'joint' => 'knee',
            'range_of_motion' => 'Full',
            'swelling' => false,
            'tenderness' => false,
            'deformity' => null,
            'findings' => 'Normal leg joint examination',
            'examined_at' => now(),
        ];
    }
}
