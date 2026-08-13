<?php

namespace Modules\PendaftaranPatientGuardian\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PendaftaranPatientGuardian\Models\PatientGuardian;
use Modules\PendaftaranRegistration\Models\Registration;

class PatientGuardianFactory extends Factory
{
    protected $model = PatientGuardian::class;

    public function definition(): array
    {
        return [
            'registration_id' => Registration::factory(),
            'full_name' => fake()->name(),
            'relationship_to_patient' => fake()->randomElement(PatientGuardian::RELATIONSHIP_TYPES),
            'identity_number' => fake()->numerify('################'),
            'phone_number' => fake()->numerify('08##########'),
            'address' => fake()->address(),
            'occupation' => fake()->jobTitle(),
            'created_by' => null,
            'status' => 'active',
        ];
    }
}
