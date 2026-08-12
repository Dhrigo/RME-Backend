<?php

namespace Modules\PendaftaranReferral\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranReferral\Models\Referral;

class ReferralFactory extends Factory
{
    protected $model = Referral::class;

    public function definition(): array
    {
        return [
            'referral_number' => fake()->unique()->numerify('RUJ-##########'),
            'patient_id' => Patient::factory(),
            'direction' => 'incoming',
            'facility_name' => fake()->company().' Hospital',
            'reason' => fake()->sentence(8),
            'referred_at' => now(),
            'status' => 'pending',
        ];
    }
}
