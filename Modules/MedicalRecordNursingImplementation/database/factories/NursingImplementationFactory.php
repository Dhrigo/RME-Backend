<?php

namespace Modules\MedicalRecordNursingImplementation\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\MedicalRecordNursingDiagnosis\Models\NursingDiagnosis;
use Modules\MedicalRecordNursingImplementation\Models\NursingImplementation;

class NursingImplementationFactory extends Factory
{
    protected $model = NursingImplementation::class;

    public function definition(): array
    {
        return [
            'nursing_diagnosis_id' => NursingDiagnosis::factory(),
            'action_taken' => fake()->sentence(),
            'performed_by' => Employee::factory(),
            'performed_at' => now(),
            'patient_response' => fake()->sentence(),
        ];
    }
}
