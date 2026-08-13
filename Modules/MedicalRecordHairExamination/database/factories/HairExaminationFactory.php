<?php

namespace Modules\MedicalRecordHairExamination\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordHairExamination\Models\HairExamination;

class HairExaminationFactory extends Factory
{
    protected $model = HairExamination::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'distribution' => 'Evenly distributed',
            'texture' => 'Normal',
            'color' => 'Black',
            'hair_loss' => false,
            'scalp_condition' => 'No lesions',
            'findings' => 'Normal hair examination',
            'examined_at' => now(),
        ];
    }
}
