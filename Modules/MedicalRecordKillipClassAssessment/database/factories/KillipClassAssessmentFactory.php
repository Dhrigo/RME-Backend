<?php

namespace Modules\MedicalRecordKillipClassAssessment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordKillipClassAssessment\Models\KillipClassAssessment;

class KillipClassAssessmentFactory extends Factory
{
    protected $model = KillipClassAssessment::class;

    public function definition(): array
    {
        return [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory(),
            'assessed_by' => \Modules\GeneralEmployee\Models\Employee::factory(),
            'created_by' => null,
            'killip_class' => fake()->numberBetween(1,4),
            'heart_rate' => fake()->numberBetween(60,140),
            'respiratory_rate' => fake()->numberBetween(12,40),
            'rales_present' => fake()->boolean(),
            's3_gallop_present' => fake()->boolean(),
            'notes' => null,
            'assessed_at' => now(),
        ];
    }
}
