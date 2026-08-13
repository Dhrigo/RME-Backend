<?php

namespace Modules\MedicalRecordClinicalNoteVerification\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordClinicalNoteVerification\Models\ClinicalNoteVerification;
use Modules\MedicalRecordClinicalNote\Models\ClinicalNote;
use Modules\GeneralDoctor\Models\Doctor;

class ClinicalNoteVerificationFactory extends Factory
{
    protected $model = ClinicalNoteVerification::class;

    public function definition(): array
    {
        return [
            'clinical_note_id' => ClinicalNote::factory(),
            'verifier_doctor_id' => Doctor::factory(),
            'verification_status' => 'Verified',
            'verified_at' => now(),
            'notes' => 'CPPT entry verified by DPJP doctor',
        ];
    }
}
