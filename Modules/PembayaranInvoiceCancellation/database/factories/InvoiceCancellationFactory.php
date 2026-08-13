<?php

namespace Modules\PembayaranInvoiceCancellation\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Auth\Models\User;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PembayaranInvoiceCancellation\Models\InvoiceCancellation;

class InvoiceCancellationFactory extends Factory
{
    protected $model = InvoiceCancellation::class;

    public function definition(): array
    {
        return [
            'invoice_id' => Invoice::factory(),
            'cancelled_at' => now(),
            'cancelled_by' => User::factory(),
            'reason' => fake()->sentence(),
        ];
    }
}
