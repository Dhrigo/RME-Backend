<?php

namespace Modules\MedicalRecordDischargePlanningRiskFactor\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordDischargePlanningRiskFactor\Models\DischargePlanningRiskFactor;

class DischargePlanningRiskFactorFactory extends Factory
{
    protected $model = DischargePlanningRiskFactor::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'risk_factor' => fake()->words(3, true),
            'score' => fake()->numberBetween(1, 10),
            'assessed_by' => Employee::factory(),
            'assessed_at' => now(),
        ];
    }
}
