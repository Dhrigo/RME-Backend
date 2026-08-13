<?php

namespace Modules\MedicalRecordToeExamination\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordToeExamination\Models\ToeExamination;

class ToeExaminationFactory extends Factory
{
    protected $model = ToeExamination::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'foot_side' => 'right',
            'deformity' => 'None',
            'ulceration' => false,
            'capillary_refill_seconds' => 1.5,
            'sensation_monofilament' => 'Intact',
            'notes' => $this->faker->sentence(),
            'examined_at' => now(),
        ];
    }
}
