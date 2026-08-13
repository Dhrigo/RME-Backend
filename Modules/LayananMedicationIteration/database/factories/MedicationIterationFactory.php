<?php

namespace Modules\LayananMedicationIteration\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\LayananMedicationIteration\Models\MedicationIteration;

class MedicationIterationFactory extends Factory
{
    protected $model = MedicationIteration::class;

    public function definition(): array
    {
        return [
            'prescription_id' => \Modules\LayananPrescription\Models\Prescription::factory(),
            'iteration_number' => fake()->numberBetween(1, 20),
            'quantity' => fake()->numberBetween(1, 20),
            'dispensed_at' => fake()->dateTimeBetween('-1 month', 'now')->format('Y-m-d H:i:s'),
            'status' => fake()->randomElement(['pending', 'dispensed']),
        ];
    }
}
