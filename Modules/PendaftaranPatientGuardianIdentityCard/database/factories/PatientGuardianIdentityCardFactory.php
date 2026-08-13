<?php

namespace Modules\PendaftaranPatientGuardianIdentityCard\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PendaftaranPatientGuardian\Models\PatientGuardian;
use Modules\PendaftaranPatientGuardianIdentityCard\Models\PatientGuardianIdentityCard;

class PatientGuardianIdentityCardFactory extends Factory
{
    protected $model = PatientGuardianIdentityCard::class;

    public function definition(): array
    {
        return [
            'patient_guardian_id' => PatientGuardian::factory(),
            'card_type' => fake()->randomElement(PatientGuardianIdentityCard::CARD_TYPES),
            'card_number' => fake()->numerify('################'),
            'issued_date' => fake()->date(),
            'address' => fake()->address(),
            'rt' => fake()->numerify('###'),
            'rw' => fake()->numerify('###'),
            'postal_code' => fake()->numerify('#####'),
            'region_code' => fake()->numerify('##.##'),
        ];
    }
}
