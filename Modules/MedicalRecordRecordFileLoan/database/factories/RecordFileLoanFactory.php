<?php

namespace Modules\MedicalRecordRecordFileLoan\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordRecordFileLoan\Models\RecordFileLoan;

class RecordFileLoanFactory extends Factory
{
    protected $model = RecordFileLoan::class;

    public function definition(): array
    {
        return [
            'patient_id' => 1,
            'borrower_name' => 'Dr. Ahmad Setiawan',
            'borrower_unit' => 'Poli Penyakit Dalam',
            'purpose' => 'Medical audit review',
            'loaned_at' => now(),
            'due_at' => now()->addDays(3),
            'returned_at' => null,
            'status' => 'borrowed',
        ];
    }
}
