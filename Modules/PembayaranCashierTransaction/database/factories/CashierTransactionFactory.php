<?php

namespace Modules\PembayaranCashierTransaction\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PembayaranCashier\Models\Cashier;
use Modules\PembayaranCashierTransaction\Models\CashierTransaction;
use Modules\PembayaranInvoice\Models\Invoice;

class CashierTransactionFactory extends Factory
{
    protected $model = CashierTransaction::class;

    public function definition(): array
    {
        return [
            'cashier_id' => Cashier::factory(),
            'invoice_id' => Invoice::factory(),
            'amount' => fake()->randomFloat(2, 10000, 5000000),
            'transaction_type' => fake()->randomElement(CashierTransaction::TRANSACTION_TYPES),
            'transacted_at' => now(),
        ];
    }
}
