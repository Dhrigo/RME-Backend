<?php

namespace Modules\PendaftaranApplicant\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PendaftaranApplicant\Models\Applicant;
use Modules\PendaftaranRegistration\Models\Registration;

class ApplicantFactory extends Factory
{
    protected $model = Applicant::class;

    public function definition(): array
    {
        return [
            'registration_id' => Registration::factory(),
            'full_name' => fake()->name(),
            'relationship_to_patient' => fake()->randomElement(Applicant::RELATIONSHIP_TYPES),
            'identity_number' => fake()->numerify('################'),
            'phone_number' => fake()->numerify('08##########'),
            'address' => fake()->address(),
            'application_type' => fake()->randomElement(Applicant::APPLICATION_TYPES),
            'application_date' => now(),
            'notes' => null,
            'created_by' => null,
            'status' => 'submitted',
        ];
    }
}
