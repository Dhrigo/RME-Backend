<?php

namespace Modules\MedicalRecordUpperArmExamination\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordUpperArmExamination\Models\UpperArmExamination;

class UpperArmExaminationFactory extends Factory
{
    protected $model = UpperArmExamination::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'side' => 'bilateral',
            'muscle_strength' => '5/5',
            'range_of_motion' => 'Full',
            'deformity' => false,
            'findings' => 'Normal upper arm examination',
            'examined_at' => now(),
        ];
    }
}
