<?php

namespace Modules\BerkasKlaimRadiologyClaim\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\BerkasKlaimClaimFile\Models\ClaimFile;
use Modules\BerkasKlaimRadiologyClaim\Models\RadiologyClaim;
use Modules\LayananLabOrder\Models\LabOrder;

class RadiologyClaimFactory extends Factory
{
    protected $model = RadiologyClaim::class;

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
