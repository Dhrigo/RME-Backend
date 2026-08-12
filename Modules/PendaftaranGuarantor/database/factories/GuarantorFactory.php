<?php

namespace Modules\PendaftaranGuarantor\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PendaftaranGuarantor\Models\Guarantor;
use Modules\PendaftaranRegistration\Models\Registration;

class GuarantorFactory extends Factory
{
    protected $model = Guarantor::class;

    public function definition(): array
    {
        return [
            'registration_id' => Registration::factory(),
            'payer_type' => 'self_pay',
            'member_number' => null,
            'room_class_id' => null,
            'reference_letter_number' => null,
            'notes' => null,
            'created_by' => null,
            'status' => 'active',
        ];
    }

    public function bpjs(): static
    {
        return $this->state(fn () => [
            'payer_type' => 'bpjs',
            'member_number' => fake()->numerify('#################'),
        ]);
    }
}
