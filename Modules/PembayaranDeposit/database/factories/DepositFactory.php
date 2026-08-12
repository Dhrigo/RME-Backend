<?php

namespace Modules\PembayaranDeposit\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Auth\Models\User;
use Modules\PembayaranDeposit\Models\Deposit;
use Modules\PendaftaranVisit\Models\Visit;

class DepositFactory extends Factory
{
    protected $model = Deposit::class;

    public function definition(): array
    {
        return [
            'deposit_number' => fake()->unique()->numerify('DEP-##########'),
            'visit_id' => Visit::factory(),
            'amount' => fake()->randomFloat(2, 100000, 5000000),
            'paid_at' => now(),
            'received_by' => User::factory(),
            'notes' => null,
            'status' => 'held',
        ];
    }
}
