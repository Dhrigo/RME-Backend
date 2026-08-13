<?php

namespace Modules\GeneralStaffWardAssignment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralStaffWardAssignment\Models\StaffWardAssignment;
use Modules\GeneralStaffMember\Models\StaffMember;
use Modules\GeneralWard\Models\Ward;

class StaffWardAssignmentFactory extends Factory
{
    protected $model = StaffWardAssignment::class;

    public function definition(): array
    {
        return [
            'staff_member_id' => StaffMember::factory(),
            'ward_id' => Ward::factory(),
            'assigned_at' => now(),
        ];
    }
}
