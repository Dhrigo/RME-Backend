<?php

namespace Modules\PembayaranCorporateReceivable\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PembayaranCorporateReceivable\Models\CorporateReceivable;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PendaftaranGuarantor\Models\Guarantor;

class CorporateReceivableFactory extends Factory
{
    protected $model = CorporateReceivable::class;

    public function definition(): array
    {
        return [
            'invoice_id' => Invoice::factory(),
            'guarantor_id' => Guarantor::factory(),
            'amount' => fake()->randomFloat(2, 50000, 10000000),
            'due_date' => now()->addDays(30)->toDateString(),
            'status' => 'outstanding',
        ];
    }
}
