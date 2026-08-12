<?php

namespace Modules\PembayaranInvoiceItem\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PembayaranInvoiceItem\Models\InvoiceItem;

class InvoiceItemFactory extends Factory
{
    protected $model = InvoiceItem::class;

    public function definition(): array
    {
        $quantity = fake()->numberBetween(1, 3);
        $unitPrice = fake()->randomFloat(2, 10000, 500000);

        return [
            'invoice_id' => Invoice::factory(),
            'description' => fake()->sentence(3),
            'category' => fake()->randomElement(['procedure', 'room', 'medicine', 'lab']),
            'quantity' => $quantity,
            'unit_price' => $unitPrice,
            'subtotal' => $quantity * $unitPrice,
        ];
    }
}
