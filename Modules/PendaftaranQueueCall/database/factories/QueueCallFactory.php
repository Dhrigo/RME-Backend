<?php

namespace Modules\PendaftaranQueueCall\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Auth\Models\User;
use Modules\PendaftaranQueueCall\Models\QueueCall;
use Modules\PendaftaranWardQueue\Models\WardQueue;

class QueueCallFactory extends Factory
{
    protected $model = QueueCall::class;

    public function definition(): array
    {
        return [
            'ward_queue_id' => WardQueue::factory(),
            'called_at' => now(),
            'called_by' => User::factory(),
            'counter' => fake()->randomElement(['1', '2', '3', 'A', 'B']),
        ];
    }
}
