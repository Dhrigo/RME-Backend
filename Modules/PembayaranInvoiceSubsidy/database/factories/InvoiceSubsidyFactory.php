<?php

namespace Modules\PembayaranInvoiceSubsidy\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PembayaranInvoiceSubsidy\Models\InvoiceSubsidy;

class InvoiceSubsidyFactory extends Factory
{
    protected $model = InvoiceSubsidy::class;

    public function definition(): array
    {
        return [
            'invoice_id' => Invoice::factory(),
            'subsidy_source' => fake()->randomElement(InvoiceSubsidy::SUBSIDY_SOURCES),
            'subsidy_amount' => fake()->randomFloat(2, 50000, 1000000),
            'approved_by' => null,
            'approved_at' => null,
            'status' => 'pending',
            'notes' => null,
        ];
    }
}
