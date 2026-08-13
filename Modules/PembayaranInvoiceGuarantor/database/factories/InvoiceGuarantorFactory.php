<?php

namespace Modules\PembayaranInvoiceGuarantor\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PembayaranInvoiceGuarantor\Models\InvoiceGuarantor;
use Modules\PendaftaranGuarantor\Models\Guarantor;

class InvoiceGuarantorFactory extends Factory
{
    protected $model = InvoiceGuarantor::class;

    public function definition(): array
    {
        return [
            'invoice_id' => Invoice::factory(),
            'guarantor_id' => Guarantor::factory(),
            'covered_amount' => fake()->randomFloat(2, 100000, 5000000),
            'coverage_percentage' => fake()->randomFloat(2, 50, 100),
            'verification_status' => 'pending',
            'verified_by' => null,
            'verified_at' => null,
            'notes' => null,
        ];
    }
}
