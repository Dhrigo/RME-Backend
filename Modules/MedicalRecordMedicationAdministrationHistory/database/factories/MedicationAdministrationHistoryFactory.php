<?php

namespace Modules\MedicalRecordMedicationAdministrationHistory\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordMedicationAdministrationHistory\Models\MedicationAdministrationHistory;

class MedicationAdministrationHistoryFactory extends Factory
{
    protected $model = MedicationAdministrationHistory::class;

    public function definition(): array
    {
        return [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory(),
            'administered_by' => \Modules\GeneralEmployee\Models\Employee::factory(),
            'created_by' => null,
            'drug_name' => fake()->word(),
            'dose' => fake()->numberBetween(1,500).'mg',
            'route' => fake()->randomElement(['oral','iv','im','sc']),
            'administered_at' => now(),
            'notes' => null,
        ];
    }
}
