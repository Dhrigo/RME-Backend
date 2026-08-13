<?php

namespace Modules\MedicalRecordEmergencyEducation\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordEmergencyEducation\Models\EmergencyEducation;

class EmergencyEducationFactory extends Factory
{
    protected $model = EmergencyEducation::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'topic' => fake()->words(3, true),
            'method' => fake()->words(3, true),
            'understanding_level' => fake()->words(3, true),
            'educator_id' => Employee::factory(),
            'educated_at' => now(),
            'notes' => fake()->sentence(),
        ];
    }
}
