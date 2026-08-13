<?php

namespace Modules\PembayaranCorporateReceivableSettlement\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Auth\Models\User;
use Modules\PembayaranCorporateReceivable\Models\CorporateReceivable;
use Modules\PembayaranCorporateReceivableSettlement\Models\CorporateReceivableSettlement;

class CorporateReceivableSettlementFactory extends Factory
{
    protected $model = CorporateReceivableSettlement::class;

    public function definition(): array
    {
        return [
            'corporate_receivable_id' => CorporateReceivable::factory(),
            'paid_amount' => fake()->randomFloat(2, 50000, 10000000),
            'paid_at' => now(),
            'received_by' => User::factory(),
        ];
    }
}
