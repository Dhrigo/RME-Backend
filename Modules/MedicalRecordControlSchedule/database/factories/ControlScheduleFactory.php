<?php

namespace Modules\MedicalRecordControlSchedule\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralMedicalDepartment\Models\MedicalDepartment;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordControlSchedule\Models\ControlSchedule;

class ControlScheduleFactory extends Factory
{
    protected $model = ControlSchedule::class;

    public function definition(): array
    {
        return [
            'patient_id' => Patient::factory(),
            'visit_id' => Visit::factory(),
            'medical_department_id' => MedicalDepartment::factory(),
            'scheduled_date' => now()->toDateString(),
            'purpose' => fake()->sentence(),
            'scheduled_by' => Employee::factory(),
            'status' => 'scheduled',
            'notes' => fake()->sentence(),
        ];
    }
}
