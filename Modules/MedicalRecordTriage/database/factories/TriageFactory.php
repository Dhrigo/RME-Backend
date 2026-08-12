<?php

namespace Modules\MedicalRecordTriage\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\MedicalRecordTriage\Models\Triage;
use Modules\PendaftaranVisit\Models\Visit;

class TriageFactory extends Factory
{
    protected $model = Triage::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'level' => fake()->numberBetween(1, 5),
            'chief_complaint' => fake()->sentence(6),
            'assessed_by' => Employee::factory(),
            'assessed_at' => now(),
            'notes' => null,
            'created_by' => null,
        ];
    }
}
