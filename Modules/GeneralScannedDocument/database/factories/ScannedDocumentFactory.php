<?php

namespace Modules\GeneralScannedDocument\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralPatient\Models\Patient;
use Modules\GeneralScannedDocument\Models\ScannedDocument;

class ScannedDocumentFactory extends Factory
{
    protected $model = ScannedDocument::class;

    public function definition(): array
    {
        return [
            'patient_id' => Patient::factory(),
            'document_type' => fake()->randomElement(['ktp', 'kartu_bpjs', 'surat_rujukan', 'hasil_lab']),
            'file_path' => 'scans/'.fake()->uuid().'.pdf',
            'scanned_at' => fake()->dateTimeBetween('-1 year'),
            'scanned_by' => Employee::factory(),
        ];
    }
}
