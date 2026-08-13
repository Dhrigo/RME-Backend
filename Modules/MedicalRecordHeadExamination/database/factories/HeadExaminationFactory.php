<?php

namespace Modules\MedicalRecordHeadExamination\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordHeadExamination\Models\HeadExamination;

class HeadExaminationFactory extends Factory
{
    protected $model = HeadExamination::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'skull_shape' => 'Normocephalic',
            'hair_distribution' => 'Evenly distributed',
            'facial_symmetry' => 'Symmetrical',
            'tenderness' => false,
            'findings' => 'Normal head examination',
            'examined_at' => now(),
        ];
    }
}
