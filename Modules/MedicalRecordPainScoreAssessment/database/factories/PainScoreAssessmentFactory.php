<?php

namespace Modules\MedicalRecordPainScoreAssessment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordPainScoreAssessment\Models\PainScoreAssessment;

class PainScoreAssessmentFactory extends Factory
{
    protected $model = PainScoreAssessment::class;

    public function definition(): array
    {
        return [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory(),
            'assessed_by' => \Modules\GeneralEmployee\Models\Employee::factory(),
            'created_by' => null,
            'scale_type' => fake()->randomElement(['NRS','WONG_BAKER','FLACC','CRIES']),
            'score' => fake()->numberBetween(0,10),
            'location' => fake()->words(2,true),
            'character' => fake()->randomElement(['sharp','dull','throbbing','burning']),
            'notes' => null,
            'assessed_at' => now(),
        ];
    }
}
