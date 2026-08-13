<?php

namespace Modules\LayananPatientDischargeRecord\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\LayananPatientDischargeRecord\Models\PatientDischargeRecord;

class PatientDischargeRecordFactory extends Factory
{
    protected $model = PatientDischargeRecord::class;

    public function definition(): array
    {
        return [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory(),
            'patient_id' => \Modules\GeneralPatient\Models\Patient::factory(),
            'discharged_at' => fake()->dateTimeBetween('-1 month', 'now')->format('Y-m-d H:i:s'),
            'discharge_method' => fake()->randomElement(['healed', 'improved', 'against_medical_advice', 'referred', 'died']),
            'discharged_by' => \Modules\GeneralEmployee\Models\Employee::factory(),
            'follow_up_notes' => fake()->paragraph(),
        ];
    }
}
