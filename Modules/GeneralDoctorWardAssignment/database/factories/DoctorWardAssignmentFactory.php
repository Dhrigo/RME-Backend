<?php

namespace Modules\GeneralDoctorWardAssignment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralDoctorWardAssignment\Models\DoctorWardAssignment;
use Modules\GeneralDoctor\Models\Doctor;
use Modules\GeneralWard\Models\Ward;

class DoctorWardAssignmentFactory extends Factory
{
    protected $model = DoctorWardAssignment::class;

    public function definition(): array
    {
        return [
            'doctor_id' => Doctor::factory(),
            'ward_id' => Ward::factory(),
            'assigned_at' => now(),
            'schedule_day' => $this->faker->dayOfWeek,
        ];
    }
}
