<?php

namespace Modules\MedicalRecordClinicalNoteCoManagement\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralMedicalDepartment\Models\MedicalDepartment;
use Modules\MedicalRecordClinicalNote\Models\ClinicalNote;
use Modules\MedicalRecordClinicalNoteCoManagement\Models\ClinicalNoteCoManagement;

class ClinicalNoteCoManagementFactory extends Factory
{
    protected $model = ClinicalNoteCoManagement::class;

    public function definition(): array
    {
        return [
            'clinical_note_id' => ClinicalNote::factory(),
            'medical_department_id' => MedicalDepartment::factory(),
            'notes' => fake()->sentence(),
            'author_id' => Employee::factory(),
            'recorded_at' => now(),
        ];
    }
}
