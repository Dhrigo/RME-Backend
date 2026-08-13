<?php

namespace Modules\PendaftaranPatientEscortIdentityCard\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PendaftaranPatientEscort\Models\PatientEscort;
use Modules\PendaftaranPatientEscortIdentityCard\Models\PatientEscortIdentityCard;

class PatientEscortIdentityCardFactory extends Factory
{
    protected $model = PatientEscortIdentityCard::class;

    public function definition(): array
    {
        return [
            'patient_escort_id' => PatientEscort::factory(),
            'card_type' => fake()->randomElement(PatientEscortIdentityCard::CARD_TYPES),
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
