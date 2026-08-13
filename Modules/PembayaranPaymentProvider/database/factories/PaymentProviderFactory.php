<?php

namespace Modules\PembayaranPaymentProvider\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PembayaranPaymentProvider\Models\PaymentProvider;

class PaymentProviderFactory extends Factory
{
    protected $model = PaymentProvider::class;

    public function definition(): array
    {
        return [
            'provider_code' => fake()->unique()->bothify('PRV-????'),
            'provider_name' => fake()->company(),
            'provider_type' => fake()->randomElement(PaymentProvider::PROVIDER_TYPES),
            'merchant_id' => fake()->numerify('MID##########'),
            'api_base_url' => fake()->url(),
            'contact_person' => fake()->name(),
            'contact_phone' => fake()->phoneNumber(),
            'is_active' => true,
        ];
    }
}
