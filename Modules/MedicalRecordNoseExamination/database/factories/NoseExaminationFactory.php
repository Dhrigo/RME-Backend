<?php

namespace Modules\MedicalRecordNoseExamination\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordNoseExamination\Models\NoseExamination;

class NoseExaminationFactory extends Factory
{
    protected $model = NoseExamination::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'deformity' => 'None',
            'septum_deviation' => false,
            'turbinate_hypertrophy' => false,
            'nasal_discharge' => 'Clear',
            'polyp_present' => false,
            'notes' => $this->faker->sentence(),
            'examined_at' => now(),
        ];
    }
}
