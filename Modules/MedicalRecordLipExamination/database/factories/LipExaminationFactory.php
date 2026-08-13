<?php

namespace Modules\MedicalRecordLipExamination\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordLipExamination\Models\LipExamination;

class LipExaminationFactory extends Factory
{
    protected $model = LipExamination::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'color' => 'Normal Pink',
            'symmetry' => 'Symmetrical',
            'lesions' => 'None',
            'moisture' => 'Normal',
            'notes' => $this->faker->sentence(),
            'examined_at' => now(),
        ];
    }
}
