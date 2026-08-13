<?php

namespace Modules\MedicalRecordHandJointExamination\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordHandJointExamination\Models\HandJointExamination;

class HandJointExaminationFactory extends Factory
{
    protected $model = HandJointExamination::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'joint' => 'wrist',
            'range_of_motion' => 'Full',
            'swelling' => false,
            'tenderness' => false,
            'deformity' => null,
            'findings' => 'Normal hand joint examination',
            'examined_at' => now(),
        ];
    }
}
