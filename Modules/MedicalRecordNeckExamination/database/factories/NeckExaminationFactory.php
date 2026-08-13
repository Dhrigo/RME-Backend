<?php

namespace Modules\MedicalRecordNeckExamination\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordNeckExamination\Models\NeckExamination;

class NeckExaminationFactory extends Factory
{
    protected $model = NeckExamination::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'lymph_nodes' => 'No palpable lymphadenopathy',
            'thyroid' => 'Not enlarged',
            'jugular_venous_pressure' => 'Not elevated',
            'trachea_position' => 'Midline',
            'mass' => false,
            'findings' => 'Normal neck examination',
            'examined_at' => now(),
        ];
    }
}
