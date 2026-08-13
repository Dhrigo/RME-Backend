<?php

namespace Modules\GeneralMedicalDepartmentWardAssignment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralMedicalDepartment\Models\MedicalDepartment;
use Modules\GeneralMedicalDepartmentWardAssignment\Models\MedicalDepartmentWardAssignment;
use Modules\GeneralWard\Models\Ward;

class MedicalDepartmentWardAssignmentFactory extends Factory
{
    protected $model = MedicalDepartmentWardAssignment::class;

    public function definition(): array
    {
        return [
            'medical_department_id' => MedicalDepartment::factory(),
            'ward_id' => Ward::factory(),
            'is_primary' => true,
            'assigned_at' => fake()->date(),
        ];
    }
}
