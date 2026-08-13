<?php

namespace Modules\PendaftaranWardQueue\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralWard\Models\Ward;
use Modules\PendaftaranWardQueue\Models\WardQueue;

class WardQueueFactory extends Factory
{
    protected $model = WardQueue::class;

    public function definition(): array
    {
        return [
            'ward_id' => Ward::factory(),
            'queue_number' => fake()->unique()->numberBetween(1, 999),
            'visit_id' => null,
            'called_at' => null,
            'status' => 'waiting',
        ];
    }
}
