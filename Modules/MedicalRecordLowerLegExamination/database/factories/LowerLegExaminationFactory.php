<?php

namespace Modules\MedicalRecordLowerLegExamination\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordLowerLegExamination\Models\LowerLegExamination;

class LowerLegExaminationFactory extends Factory
{
    protected $model = LowerLegExamination::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'side' => 'bilateral',
            'muscle_strength' => '5/5',
            'edema' => false,
            'pulses' => 'Palpable, 2+',
            'skin_condition' => 'Intact, no ulcers',
            'findings' => 'Normal lower leg examination',
            'examined_at' => now(),
        ];
    }
}
