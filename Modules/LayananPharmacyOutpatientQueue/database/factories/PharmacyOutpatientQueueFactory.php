<?php

namespace Modules\LayananPharmacyOutpatientQueue\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\LayananPharmacyOutpatientQueue\Models\PharmacyOutpatientQueue;

class PharmacyOutpatientQueueFactory extends Factory
{
    protected $model = PharmacyOutpatientQueue::class;

    public function definition(): array
    {
        return [
            'prescription_id' => \Modules\LayananPrescription\Models\Prescription::factory(),
            'queue_number' => fake()->words(3, true),
            'status' => fake()->randomElement(['waiting', 'called', 'done']),
            'called_at' => fake()->dateTimeBetween('-1 month', 'now')->format('Y-m-d H:i:s'),
            'completed_at' => fake()->dateTimeBetween('-1 month', 'now')->format('Y-m-d H:i:s'),
        ];
    }
}
