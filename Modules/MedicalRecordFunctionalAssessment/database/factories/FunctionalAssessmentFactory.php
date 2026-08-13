<?php

namespace Modules\MedicalRecordFunctionalAssessment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordFunctionalAssessment\Models\FunctionalAssessment;

class FunctionalAssessmentFactory extends Factory
{
    protected $model = FunctionalAssessment::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'assessment_date' => now()->toDateString(),
            'mobility_status' => fake()->words(3, true),
            'adl_score' => fake()->numberBetween(1, 10),
            'assistive_device' => fake()->words(3, true),
            'assessed_by' => Employee::factory(),
            'notes' => fake()->sentence(),
        ];
    }
}
