<?php

namespace Modules\LayananPharmacyDispense\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\LayananPharmacyDispense\Models\PharmacyDispense;

class PharmacyDispenseFactory extends Factory
{
    protected $model = PharmacyDispense::class;

    public function definition(): array
    {
        return [
            'prescription_id' => \Modules\LayananPrescription\Models\Prescription::factory(),
            'dispensed_by' => \Modules\Auth\Models\User::factory(),
            'dispensed_at' => fake()->dateTimeBetween('-1 month', 'now')->format('Y-m-d H:i:s'),
            'quantity' => fake()->numberBetween(1, 20),
            'status' => fake()->randomElement(['pending', 'dispensed', 'cancelled']),
        ];
    }
}
