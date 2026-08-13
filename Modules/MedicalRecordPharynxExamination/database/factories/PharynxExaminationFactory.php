<?php

namespace Modules\MedicalRecordPharynxExamination\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordPharynxExamination\Models\PharynxExamination;

class PharynxExaminationFactory extends Factory
{
    protected $model = PharynxExamination::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'mucosa_color' => 'Normal Pink',
            'exudate' => false,
            'post_nasal_drip' => false,
            'posterior_wall_condition' => 'Smooth',
            'notes' => $this->faker->sentence(),
            'examined_at' => now(),
        ];
    }
}
