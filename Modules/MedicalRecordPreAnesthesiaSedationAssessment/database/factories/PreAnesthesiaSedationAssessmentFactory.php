<?php

namespace Modules\MedicalRecordPreAnesthesiaSedationAssessment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordPreAnesthesiaSedationAssessment\Models\PreAnesthesiaSedationAssessment;

class PreAnesthesiaSedationAssessmentFactory extends Factory
{
    protected $model = PreAnesthesiaSedationAssessment::class;

    public function definition(): array
    {
        return [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory(),
            'doctor_id' => \Modules\GeneralDoctor\Models\Doctor::factory(),
            'created_by' => null,
            'asa_classification' => fake()->randomElement(['I','II','III','IV']),
            'mallampati_class' => fake()->numberBetween(1,4),
            'npo_hours' => fake()->numberBetween(6,12),
            'comorbidities' => null,
            'planned_anesthesia_type' => fake()->randomElement(['general','regional','local','sedation']),
            'risk_notes' => null,
            'assessed_at' => now(),
        ];
    }
}
