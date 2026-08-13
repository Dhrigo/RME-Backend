<?php

namespace Modules\GeneralStaffMember\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralStaffMember\Models\StaffMember;
use Modules\GeneralEmployee\Models\Employee;

class StaffMemberFactory extends Factory
{
    protected $model = StaffMember::class;

    public function definition(): array
    {
        return [
            'employee_id' => Employee::factory(),
            'staff_role' => $this->faker->jobTitle,
            'is_active' => true,
        ];
    }
}
