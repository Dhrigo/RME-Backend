<?php

namespace Modules\PembayaranTransfer\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PembayaranPayment\Models\Payment;
use Modules\PembayaranTransfer\Models\Transfer;

class TransferFactory extends Factory
{
    protected $model = Transfer::class;

    public function definition(): array
    {
        return [
            'payment_id' => Payment::factory(),
            'transfer_reference_number' => fake()->unique()->numerify('TRF-##########'),
            'source_bank_name' => fake()->randomElement(['BCA', 'Mandiri', 'BNI', 'BRI']),
            'destination_account_number' => fake()->numerify('##########'),
            'destination_account_name' => 'RSU Simgos',
            'amount' => fake()->randomFloat(2, 50000, 5000000),
            'transferred_at' => now(),
            'proof_file_path' => null,
            'status' => 'pending',
        ];
    }
}
