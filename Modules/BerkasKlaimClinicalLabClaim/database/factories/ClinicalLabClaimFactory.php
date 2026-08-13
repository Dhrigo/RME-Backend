<?php

namespace Modules\BerkasKlaimClinicalLabClaim\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\BerkasKlaimClaimFile\Models\ClaimFile;
use Modules\BerkasKlaimClinicalLabClaim\Models\ClinicalLabClaim;
use Modules\LayananLabOrder\Models\LabOrder;

class ClinicalLabClaimFactory extends Factory
{
    protected $model = ClinicalLabClaim::class;

    public function definition(): array
    {
        return [
            'claim_file_id' => ClaimFile::factory(),
            'order_id' => LabOrder::factory(),
            'submitted_at' => now(),
            'status' => 'draft',
        ];
    }
}
