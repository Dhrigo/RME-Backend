<?php

namespace Modules\MedicalRecordRavenTestExamination\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordRavenTestExamination\Models\RavenTestExamination;

class RavenTestExaminationFactory extends Factory
{
    protected $model = RavenTestExamination::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'test_form' => 'SPM',
            'raw_score' => 42,
            'percentile' => 75,
            'iq_grade' => 'III',
            'examiner_notes' => null,
            'tested_at' => now(),
        ];
    }
}
