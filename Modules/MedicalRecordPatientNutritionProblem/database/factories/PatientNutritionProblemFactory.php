<?php

namespace Modules\MedicalRecordPatientNutritionProblem\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordPatientNutritionProblem\Models\PatientNutritionProblem;

class PatientNutritionProblemFactory extends Factory
{
    protected $model = PatientNutritionProblem::class;

    public function definition(): array
    {
        return [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory(),
            'identified_by' => \Modules\GeneralEmployee\Models\Employee::factory(),
            'created_by' => null,
            'problem_category' => fake()->randomElement(['underweight','overweight','malnutrition_risk','swallowing_difficulty','poor_intake']),
            'problem_description' => fake()->sentence(8),
            'intervention_plan' => fake()->sentence(6),
            'status' => 'open',
            'identified_at' => now(),
        ];
    }
}
