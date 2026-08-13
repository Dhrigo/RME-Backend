<?php

namespace Modules\PendaftaranBedQueue\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralBed\Models\Bed;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranBedQueue\Models\BedQueue;

class BedQueueFactory extends Factory
{
    protected $model = BedQueue::class;

    public function definition(): array
    {
        return [
            'bed_id' => Bed::factory(),
            'patient_id' => Patient::factory(),
            'queue_number' => fake()->unique()->numberBetween(1, 999),
            'status' => 'waiting',
        ];
    }
}
