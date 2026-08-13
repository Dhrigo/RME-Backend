<?php

namespace Modules\BerkasKlaimPharmacyClaim\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\BerkasKlaimClaimFile\Models\ClaimFile;
use Modules\BerkasKlaimPharmacyClaim\Models\PharmacyClaim;
use Modules\LayananPrescription\Models\Prescription;

class PharmacyClaimFactory extends Factory
{
    protected $model = PharmacyClaim::class;

    public function definition(): array
    {
        return [
            'claim_file_id' => ClaimFile::factory(),
            'prescription_id' => Prescription::factory(),
            'submitted_at' => now(),
            'status' => 'draft',
        ];
    }
}
