<?php

namespace Modules\BerkasKlaimPathologyClaim\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\BerkasKlaimClaimFile\Models\ClaimFile;
use Modules\BerkasKlaimPathologyClaim\Models\PathologyClaim;
use Modules\LayananLabOrder\Models\LabOrder;

class PathologyClaimFactory extends Factory
{
    protected $model = PathologyClaim::class;

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
