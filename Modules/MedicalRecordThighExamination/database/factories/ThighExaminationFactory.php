<?php

namespace Modules\MedicalRecordThighExamination\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordThighExamination\Models\ThighExamination;

class ThighExaminationFactory extends Factory
{
    protected $model = ThighExamination::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'side' => 'bilateral',
            'muscle_strength' => '5/5',
            'circumference_cm' => 45.0,
            'swelling' => false,
            'findings' => 'Normal thigh examination',
            'examined_at' => now(),
        ];
    }
}
