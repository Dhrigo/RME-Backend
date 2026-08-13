<?php

namespace Modules\PembayaranInvoiceMerge\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PembayaranInvoiceMerge\Models\InvoiceMerge;
use Modules\PembayaranPayment\Models\Payment;

class InvoiceMergeFactory extends Factory
{
    protected $model = InvoiceMerge::class;

    public function definition(): array
    {
        return [
            'merge_number' => fake()->unique()->numerify('MRG-##########'),
            'payment_id' => Payment::factory(),
            'invoice_id' => Invoice::factory(),
            'allocated_amount' => fake()->randomFloat(2, 50000, 2000000),
            'merged_by' => null,
            'merged_at' => now(),
            'notes' => null,
        ];
    }
}
