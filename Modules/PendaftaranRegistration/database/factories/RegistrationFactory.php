<?php

namespace Modules\PendaftaranRegistration\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranRegistration\Models\Registration;

class RegistrationFactory extends Factory
{
    protected $model = Registration::class;

    public function definition(): array
    {
        return [
            'registration_number' => fake()->unique()->numerify('REG-##########'),
            'patient_id' => Patient::factory(),
            'registered_at' => now(),
            'admission_diagnosis_id' => null,
            'referral_id' => null,
            'package_id' => null,
            'is_emergency' => false,
            'has_fall_risk' => false,
            'newborn_weight_grams' => null,
            'newborn_length_cm' => null,
            'birth_time' => null,
            'found_location' => null,
            'found_at' => null,
            'satu_sehat_consent' => false,
            'registered_by' => null,
            'status' => 'active',
        ];
    }

    public function emergency(): static
    {
        return $this->state(fn () => ['is_emergency' => true]);
    }
}
