<?php

namespace Modules\LayananPatientDeathRecord\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\LayananPatientDeathRecord\Models\PatientDeathRecord;

class PatientDeathRecordFactory extends Factory
{
    protected $model = PatientDeathRecord::class;

    public function definition(): array
    {
        return [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory(),
            'patient_id' => \Modules\GeneralPatient\Models\Patient::factory(),
            'died_at' => fake()->dateTimeBetween('-1 month', 'now')->format('Y-m-d H:i:s'),
            'cause_of_death' => fake()->paragraph(),
            'declared_by' => \Modules\GeneralEmployee\Models\Employee::factory(),
            'notes' => fake()->paragraph(),
        ];
    }
}
