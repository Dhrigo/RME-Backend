<?php

namespace Modules\LayananMedicalProcedureStaff\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\LayananMedicalProcedure\Models\MedicalProcedure;
use Modules\LayananMedicalProcedureStaff\Models\MedicalProcedureStaff;

class MedicalProcedureStaffFactory extends Factory
{
    protected $model = MedicalProcedureStaff::class;

    public function definition(): array
    {
        return [
            'medical_procedure_id' => MedicalProcedure::factory(),
            'employee_id' => Employee::factory(),
            'role' => fake()->words(3, true),
            'notes' => fake()->sentence(),
        ];
    }
}
