<?php

namespace Modules\PenjaminRSAttendingPhysician\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PenjaminRSAttendingPhysician\Models\AttendingPhysician;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\GeneralEmployee\Models\Employee;

class AttendingPhysicianFactory extends Factory
{
    protected $model = AttendingPhysician::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'employee_id' => Employee::factory(),
            'assigned_at' => $this->faker->dateTime(),
            'is_primary' => $this->faker->boolean(),
        ];
    }
}
