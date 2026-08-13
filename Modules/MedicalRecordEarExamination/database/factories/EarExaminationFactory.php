<?php

namespace Modules\MedicalRecordEarExamination\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordEarExamination\Models\EarExamination;

class EarExaminationFactory extends Factory
{
    protected $model = EarExamination::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'side' => 'bilateral',
            'otoscopy' => 'Canal clear, no discharge',
            'tympanic_membrane' => 'Intact, pearly grey',
            'hearing_test_result' => 'Normal on whisper test',
            'discharge' => false,
            'findings' => 'Normal ear examination',
            'examined_at' => now(),
        ];
    }
}
