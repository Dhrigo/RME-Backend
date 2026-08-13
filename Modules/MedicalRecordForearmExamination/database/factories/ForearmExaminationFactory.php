<?php

namespace Modules\MedicalRecordForearmExamination\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordForearmExamination\Models\ForearmExamination;

class ForearmExaminationFactory extends Factory
{
    protected $model = ForearmExamination::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'side' => 'bilateral',
            'muscle_strength' => '5/5',
            'range_of_motion' => 'Full',
            'deformity' => false,
            'findings' => 'Normal forearm examination',
            'examined_at' => now(),
        ];
    }
}
