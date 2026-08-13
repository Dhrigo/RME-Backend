<?php

namespace Modules\MedicalRecordFingerExamination\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordFingerExamination\Models\FingerExamination;

class FingerExaminationFactory extends Factory
{
    protected $model = FingerExamination::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'hand_side' => 'both',
            'clubbing' => false,
            'cyanosis' => false,
            'capillary_refill_seconds' => 1.0,
            'range_of_motion' => 'Full',
            'notes' => $this->faker->sentence(),
            'examined_at' => now(),
        ];
    }
}
