<?php

namespace Modules\MedicalRecordHumptyDumptyFallScaleAssessment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordHumptyDumptyFallScaleAssessment\Models\HumptyDumptyFallScaleAssessment;

class HumptyDumptyFallScaleAssessmentFactory extends Factory
{
    protected $model = HumptyDumptyFallScaleAssessment::class;

    public function definition(): array
    {
        return [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory(),
            'assessed_by' => \Modules\GeneralEmployee\Models\Employee::factory(),
            'created_by' => null,
            'age_score' => fake()->numberBetween(1,4),
            'gender_score' => fake()->numberBetween(1,3),
            'diagnosis_score' => fake()->numberBetween(1,4),
            'cognitive_impairment_score' => fake()->numberBetween(1,3),
            'environmental_score' => fake()->numberBetween(1,4),
            'surgery_sedation_score' => fake()->numberBetween(1,3),
            'medication_score' => fake()->numberBetween(1,3),
            'total_score' => fake()->numberBetween(7,23),
            'risk_level' => fake()->randomElement(['LOW','HIGH']),
            'assessed_at' => now(),
        ];
    }
}
