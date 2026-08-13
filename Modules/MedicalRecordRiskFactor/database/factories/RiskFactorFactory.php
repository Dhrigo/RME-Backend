<?php

namespace Modules\MedicalRecordRiskFactor\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordRiskFactor\Models\RiskFactor;

class RiskFactorFactory extends Factory
{
    protected $model = RiskFactor::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'risk_category' => fake()->words(3, true),
            'description' => fake()->sentence(),
            'risk_level' => fake()->words(3, true),
            'identified_by' => Employee::factory(),
            'identified_at' => now(),
            'mitigation_plan' => fake()->sentence(),
        ];
    }
}
