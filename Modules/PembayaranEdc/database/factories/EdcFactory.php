<?php

namespace Modules\PembayaranEdc\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PembayaranEdc\Models\Edc;
use Modules\PembayaranPayment\Models\Payment;

class EdcFactory extends Factory
{
    protected $model = Edc::class;

    public function definition(): array
    {
        return [
            'payment_id' => Payment::factory(),
            'edc_reference_number' => fake()->unique()->numerify('EDC-##########'),
            'bank_name' => fake()->randomElement(['BCA', 'Mandiri', 'BNI', 'BRI']),
            'card_type' => fake()->randomElement(Edc::CARD_TYPES),
            'card_last_four' => fake()->numerify('####'),
            'approval_code' => fake()->numerify('######'),
            'amount' => fake()->randomFloat(2, 50000, 5000000),
            'transaction_at' => now(),
            'status' => 'pending',
        ];
    }
}
