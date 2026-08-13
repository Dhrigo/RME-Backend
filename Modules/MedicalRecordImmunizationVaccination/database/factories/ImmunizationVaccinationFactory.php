<?php

namespace Modules\MedicalRecordImmunizationVaccination\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordImmunizationVaccination\Models\ImmunizationVaccination;

class ImmunizationVaccinationFactory extends Factory
{
    protected $model = ImmunizationVaccination::class;

    public function definition(): array
    {
        return [
            'patient_id' => Patient::factory(),
            'visit_id' => Visit::factory(),
            'vaccine_name' => fake()->words(2, true),
            'dose_number' => fake()->numberBetween(1, 10),
            'batch_number' => fake()->words(3, true),
            'administered_at' => now(),
            'administered_by' => Employee::factory(),
            'site' => fake()->words(3, true),
            'route' => fake()->words(3, true),
            'adverse_reaction' => fake()->sentence(),
            'status' => 'completed',
        ];
    }
}
