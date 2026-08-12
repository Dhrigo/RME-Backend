<?php

namespace Modules\PembayaranInvoice\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PendaftaranVisit\Models\Visit;

class InvoiceFactory extends Factory
{
    protected $model = Invoice::class;

    public function definition(): array
    {
        return [
            'invoice_number' => fake()->unique()->numerify('INV-##########'),
            'visit_id' => Visit::factory(),
            'invoice_date' => now(),
            'subtotal' => 0,
            'rounding_adjustment' => 0,
            'total_amount' => 0,
            'is_locked' => false,
            'created_by' => null,
            'status' => 'open',
        ];
    }

    public function locked(): static
    {
        return $this->state(fn () => ['is_locked' => true, 'status' => 'paid']);
    }
}
