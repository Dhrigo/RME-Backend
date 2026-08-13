<?php

namespace Modules\PembayaranProviderService\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PembayaranPaymentProvider\Models\PaymentProvider;
use Modules\PembayaranProviderService\Models\ProviderService;

class ProviderServiceFactory extends Factory
{
    protected $model = ProviderService::class;

    public function definition(): array
    {
        return [
            'payment_provider_id' => PaymentProvider::factory(),
            'service_code' => fake()->unique()->bothify('SVC-????'),
            'service_name' => fake()->randomElement(['Virtual Account BCA', 'QRIS', 'Kartu Kredit', 'GoPay']),
            'service_type' => fake()->randomElement(ProviderService::SERVICE_TYPES),
            'admin_fee_type' => fake()->randomElement(ProviderService::ADMIN_FEE_TYPES),
            'admin_fee_amount' => fake()->randomFloat(2, 0, 10000),
            'is_active' => true,
        ];
    }
}
