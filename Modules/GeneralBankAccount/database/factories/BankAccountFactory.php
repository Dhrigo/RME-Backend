<?php

namespace Modules\GeneralBankAccount\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralBankAccount\Models\BankAccount;

class BankAccountFactory extends Factory
{
    protected $model = BankAccount::class;

    public function definition(): array
    {
        return [
            'bank_name' => fake()->company(),
            'account_number' => fake()->unique()->numerify('##########'),
            'account_holder' => fake()->name(),
            'account_type' => fake()->randomElement(['Giro', 'Tabungan']),
            'is_active' => true,
        ];
    }
}
