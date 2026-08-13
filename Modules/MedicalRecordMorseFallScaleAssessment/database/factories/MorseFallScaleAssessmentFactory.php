<?php

namespace Modules\MedicalRecordMorseFallScaleAssessment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordMorseFallScaleAssessment\Models\MorseFallScaleAssessment;

class MorseFallScaleAssessmentFactory extends Factory
{
    protected $model = MorseFallScaleAssessment::class;

    public function definition(): array
    {
        return [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory(),
            'assessed_by' => \Modules\GeneralEmployee\Models\Employee::factory(),
            'created_by' => null,
            'history_of_falling' => fake()->randomElement([0,25]),
            'secondary_diagnosis' => fake()->randomElement([0,15]),
            'ambulatory_aid' => fake()->randomElement([0,15,30]),
            'iv_therapy' => fake()->randomElement([0,20]),
            'gait' => fake()->randomElement([0,10,20]),
            'mental_status' => fake()->randomElement([0,15]),
            'total_score' => fake()->numberBetween(0,125),
            'risk_level' => fake()->randomElement(['LOW','MODERATE','HIGH']),
            'assessed_at' => now(),
        ];
    }
}
