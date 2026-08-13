<?php

namespace Modules\MedicalRecordEyeExamDocumentUpload\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordEyeExamDocumentUpload\Models\EyeExamDocumentUpload;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\GeneralDoctor\Models\Doctor;

class EyeExamDocumentUploadFactory extends Factory
{
    protected $model = EyeExamDocumentUpload::class;

    public function definition(): array
    {
        return [
            'patient_id' => Patient::factory(),
            'visit_id' => Visit::factory(),
            'doctor_id' => Doctor::factory(),
            'exam_date' => now(),
            'file_path' => 'eye_exams/2026/08/' . $this->faker->uuid() . '.jpg',
            'eye_side' => $this->faker->randomElement(['Left', 'Right', 'Both']),
            'findings' => 'Normal fundus examination, clear lens',
        ];
    }
}
