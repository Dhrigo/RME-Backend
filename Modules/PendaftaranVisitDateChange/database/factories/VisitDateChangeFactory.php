<?php

namespace Modules\PendaftaranVisitDateChange\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Auth\Models\User;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\PendaftaranVisitDateChange\Models\VisitDateChange;

class VisitDateChangeFactory extends Factory
{
    protected $model = VisitDateChange::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'old_date' => $this->faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d'),
            'new_date' => $this->faker->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
            'changed_by' => User::factory(),
            'reason' => $this->faker->sentence(),
        ];
    }
}
