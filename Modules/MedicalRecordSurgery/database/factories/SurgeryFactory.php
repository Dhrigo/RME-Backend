<?php

namespace Modules\MedicalRecordSurgery\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\MedicalRecordSurgery\Models\Surgery;
use Modules\PendaftaranVisit\Models\Visit;

class SurgeryFactory extends Factory
{
    protected $model = Surgery::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'diagnosis_id' => null,
            'procedure_name' => fake()->randomElement(['Appendectomy', 'Cholecystectomy', 'Cesarean Section', 'Hernia Repair']),
            'surgeon_id' => Employee::factory(),
            'anesthesia_type' => fake()->randomElement(['general', 'regional', 'local']),
            'started_at' => now(),
            'ended_at' => null,
            'notes' => null,
            'status' => 'scheduled',
            'created_by' => null,
        ];
    }
}
