<?php

namespace Modules\BerkasKlaimClaimFile\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\BerkasKlaimClaimFile\Models\ClaimFile;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\PembayaranInvoice\Models\Invoice;

class ClaimFileFactory extends Factory
{
    protected $model = ClaimFile::class;

    public function definition(): array
    {
        return [
            'visit_id' => Visit::factory(),
            'invoice_id' => Invoice::factory(),
            'claim_number' => $this->faker->unique()->numerify('CLM-##########'),
            'submitted_at' => null,
            'status' => 'draft',
        ];
    }
}
