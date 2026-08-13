<?php

namespace Modules\PembayaranClaimInvoice\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PembayaranClaimInvoice\Models\ClaimInvoice;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PendaftaranGuarantor\Models\Guarantor;

class ClaimInvoiceFactory extends Factory
{
    protected $model = ClaimInvoice::class;

    public function definition(): array
    {
        return [
            'claim_number' => fake()->unique()->numerify('CLM-##########'),
            'invoice_id' => Invoice::factory(),
            'guarantor_id' => Guarantor::factory(),
            'claim_amount' => fake()->randomFloat(2, 100000, 10000000),
            'verified_amount' => null,
            'submitted_at' => null,
            'status' => 'draft',
            'rejection_reason' => null,
        ];
    }
}
