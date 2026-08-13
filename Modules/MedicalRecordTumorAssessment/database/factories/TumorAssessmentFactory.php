<?php

namespace Modules\MedicalRecordTumorAssessment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordTumorAssessment\Models\TumorAssessment;

class TumorAssessmentFactory extends Factory
{
    protected $model = TumorAssessment::class;

    public function definition(): array
    {
        return [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory(),
            'diagnosis_id' => null,
            'assessed_by' => \Modules\GeneralEmployee\Models\Employee::factory(),
            'created_by' => null,
            'tumor_location' => fake()->words(2,true),
            'size_cm' => fake()->randomFloat(2,0.5,15),
            'tnm_t' => 'T'.fake()->numberBetween(1,4),
            'tnm_n' => 'N'.fake()->numberBetween(0,3),
            'tnm_m' => 'M'.fake()->numberBetween(0,1),
            'grade' => fake()->randomElement(['G1','G2','G3','G4']),
            'notes' => null,
            'assessed_at' => now(),
        ];
    }
}
