<?php

namespace Modules\GeneralDoctorMedicalDepartment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralDoctorMedicalDepartment\Models\DoctorMedicalDepartment;
use Modules\GeneralDoctor\Models\Doctor;
use Modules\GeneralMedicalDepartment\Models\MedicalDepartment;

class DoctorMedicalDepartmentFactory extends Factory
{
    protected $model = DoctorMedicalDepartment::class;

    public function definition(): array
    {
        return [
            'doctor_id' => Doctor::factory(),
            'medical_department_id' => MedicalDepartment::factory(),
            'is_head' => $this->faker->boolean,
        ];
    }
}
