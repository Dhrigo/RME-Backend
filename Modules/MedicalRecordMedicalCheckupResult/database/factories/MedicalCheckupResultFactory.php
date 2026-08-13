<?php

namespace Modules\MedicalRecordMedicalCheckupResult\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordMedicalCheckupResult\Models\MedicalCheckupResult;

class MedicalCheckupResultFactory extends Factory
{
    protected $model = MedicalCheckupResult::class;

    public function definition(): array
    {
        return [
            'patient_id' => Patient::factory(),
            'visit_id' => Visit::factory(),
            'checkup_date' => now()->toDateString(),
            'category' => fake()->words(3, true),
            'summary' => fake()->sentence(),
            'recommendation' => fake()->sentence(),
            'examined_by' => Employee::factory(),
            'status' => 'completed',
        ];
    }
}
