<?php

namespace Modules\MedicalRecordCatClamsExamination\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordCatClamsExamination\Models\CatClamsExamination;

class CatClamsExaminationFactory extends Factory
{
    protected $model = CatClamsExamination::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'patient_id' => 1,
            'cat_score' => 85.0,
            'clams_score' => 90.0,
            'developmental_quotient' => 87.5,
            'developmental_age_months' => 24.0,
            'interpretation' => 'Normal cognitive and language development',
            'examined_at' => now(),
        ];
    }
}
