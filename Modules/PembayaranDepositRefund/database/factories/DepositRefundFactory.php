<?php

namespace Modules\PembayaranDepositRefund\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Auth\Models\User;
use Modules\PembayaranDeposit\Models\Deposit;
use Modules\PembayaranDepositRefund\Models\DepositRefund;

class DepositRefundFactory extends Factory
{
    protected $model = DepositRefund::class;

    public function definition(): array
    {
        return [
            'deposit_id' => Deposit::factory(),
            'refunded_amount' => fake()->randomFloat(2, 10000, 2000000),
            'refunded_at' => now(),
            'refunded_by' => User::factory(),
        ];
    }
}
