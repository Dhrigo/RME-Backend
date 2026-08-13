<?php

namespace Modules\MedicalRecordCoughAssessment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordCoughAssessment\Models\CoughAssessment;

class CoughAssessmentFactory extends Factory
{
    protected $model = CoughAssessment::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'has_cough' => false,
            'duration_weeks' => fake()->numberBetween(1, 10),
            'cough_type' => fake()->words(3, true),
            'other_symptoms' => fake()->sentence(),
            'is_referred_tb_screening' => false,
            'assessed_by' => Employee::factory(),
            'assessed_at' => now(),
        ];
    }
}
