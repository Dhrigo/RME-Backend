<?php

namespace Modules\MedicalRecordExternalRiskFactor\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordExternalRiskFactor\Models\ExternalRiskFactor;

class ExternalRiskFactorFactory extends Factory
{
    protected $model = ExternalRiskFactor::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'factor_type' => fake()->words(3, true),
            'description' => fake()->sentence(),
            'impact_level' => fake()->words(3, true),
            'recorded_by' => Employee::factory(),
            'recorded_at' => now(),
        ];
    }
}
