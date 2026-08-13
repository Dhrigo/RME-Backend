<?php

namespace Modules\PendaftaranVisitCancellation\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Auth\Models\User;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\PendaftaranVisitCancellation\Models\VisitCancellation;

class VisitCancellationFactory extends Factory
{
    protected $model = VisitCancellation::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'cancelled_at' => $this->faker->dateTimeThisMonth(),
            'cancelled_by' => User::factory(),
            'reason' => $this->faker->sentence(),
        ];
    }
}
