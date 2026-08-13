<?php

namespace Modules\PendaftaranPatientEscort\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PendaftaranPatientEscort\Models\PatientEscort;
use Modules\PendaftaranRegistration\Models\Registration;

class PatientEscortFactory extends Factory
{
    protected $model = PatientEscort::class;

    public function definition(): array
    {
        return [
            'registration_id' => Registration::factory(),
            'full_name' => fake()->name(),
            'relationship_to_patient' => fake()->randomElement(PatientEscort::RELATIONSHIP_TYPES),
            'phone_number' => fake()->numerify('08##########'),
            'address' => fake()->address(),
            'arrival_mode' => fake()->randomElement(PatientEscort::ARRIVAL_MODES),
            'notes' => null,
            'created_by' => null,
            'status' => 'active',
        ];
    }
}
