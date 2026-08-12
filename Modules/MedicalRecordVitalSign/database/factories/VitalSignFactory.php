<?php

namespace Modules\MedicalRecordVitalSign\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\MedicalRecordVitalSign\Models\VitalSign;
use Modules\PendaftaranVisit\Models\Visit;

class VitalSignFactory extends Factory
{
    protected $model = VitalSign::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'recorded_at' => now(),
            'temperature' => fake()->randomFloat(1, 36, 38),
            'pulse' => fake()->numberBetween(60, 100),
            'respiratory_rate' => fake()->numberBetween(12, 20),
            'systolic' => fake()->numberBetween(100, 140),
            'diastolic' => fake()->numberBetween(60, 90),
            'oxygen_saturation' => fake()->numberBetween(95, 100),
            'pain_scale' => fake()->numberBetween(0, 10),
            'recorded_by' => Employee::factory(),
            'created_by' => null,
        ];
    }
}
