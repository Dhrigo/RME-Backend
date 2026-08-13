<?php

namespace Modules\MedicalRecordDocumentUpload\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordDocumentUpload\Models\DocumentUpload;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranVisit\Models\Visit;

class DocumentUploadFactory extends Factory
{
    protected $model = DocumentUpload::class;

    public function definition(): array
    {
        return [
            'patient_id' => Patient::factory(),
            'visit_id' => Visit::factory(),
            'document_name' => 'Medical_Release_Form.pdf',
            'document_type' => 'Consent Form',
            'file_path' => 'documents/2026/08/' . $this->faker->uuid() . '.pdf',
            'file_size_bytes' => $this->faker->numberBetween(100000, 2000000),
            'uploaded_at' => now(),
            'notes' => $this->faker->sentence(),
        ];
    }
}
