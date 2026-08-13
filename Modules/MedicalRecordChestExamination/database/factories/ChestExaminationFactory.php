<?php

namespace Modules\MedicalRecordChestExamination\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordChestExamination\Models\ChestExamination;

class ChestExaminationFactory extends Factory
{
    protected $model = ChestExamination::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'inspection' => 'Symmetrical chest expansion',
            'palpation' => 'Normal tactile fremitus',
            'percussion' => 'Resonant',
            'auscultation_breath_sounds' => 'Vesicular',
            'auscultation_heart_sounds' => 'S1 S2 Normal',
            'findings' => 'Normal chest examination',
            'examined_at' => now(),
        ];
    }
}
