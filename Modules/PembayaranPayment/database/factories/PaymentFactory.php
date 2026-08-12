<?php

namespace Modules\PembayaranPayment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PembayaranPayment\Models\Payment;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition(): array
    {
        return [
            'payment_number' => fake()->unique()->numerify('PAY-##########'),
            'invoice_id' => Invoice::factory(),
            'payment_method' => fake()->randomElement(['cash', 'debit', 'credit', 'transfer']),
            'amount' => fake()->randomFloat(2, 10000, 1000000),
            'admin_fee' => 0,
            'paid_at' => now(),
            'received_by' => null,
            'status' => 'completed',
        ];
    }
}
