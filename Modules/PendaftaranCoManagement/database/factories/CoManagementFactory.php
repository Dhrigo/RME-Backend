<?php

namespace Modules\PendaftaranCoManagement\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranCoManagement\Models\CoManagement;
use Modules\PendaftaranVisit\Models\Visit;

class CoManagementFactory extends Factory
{
    protected $model = CoManagement::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'employee_id' => Employee::factory(),
            'started_at' => $this->faker->dateTimeThisMonth(),
            'notes' => $this->faker->sentence(),
        ];
    }
}
