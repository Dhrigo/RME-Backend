<?php

namespace Modules\PembatalanVisitCancellation\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PembatalanVisitCancellation\Models\VisitCancellation;

class VisitCancellationFactory extends Factory
{
    protected $model = VisitCancellation::class;

    public function definition(): array
    {
        return [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory(),
            'cancelled_by' => \Modules\Auth\Models\User::factory(),
            'reason' => fake()->paragraph(),
            'cancelled_at' => fake()->dateTimeBetween('-1 month', 'now')->format('Y-m-d H:i:s'),
        ];
    }
}
