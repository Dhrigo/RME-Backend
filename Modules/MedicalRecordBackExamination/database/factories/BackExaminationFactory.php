<?php

namespace Modules\MedicalRecordBackExamination\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordBackExamination\Models\BackExamination;

class BackExaminationFactory extends Factory
{
    protected $model = BackExamination::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'spine_alignment' => 'Straight, midline',
            'scoliosis' => false,
            'kyphosis' => false,
            'lordosis' => false,
            'tenderness' => false,
            'findings' => 'Normal back examination',
            'examined_at' => now(),
        ];
    }
}
