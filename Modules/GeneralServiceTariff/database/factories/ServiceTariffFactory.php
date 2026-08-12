<?php

namespace Modules\GeneralServiceTariff\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralService\Models\Service;
use Modules\GeneralServiceTariff\Models\ServiceTariff;

class ServiceTariffFactory extends Factory
{
    protected $model = ServiceTariff::class;

    public function definition(): array
    {
        return [
            'service_id' => Service::factory(),
            'room_class_id' => null,
            'price' => fake()->randomFloat(2, 10000, 500000),
            'effective_date' => now()->subDay(),
            'decree_number' => null,
            'decree_date' => null,
            'created_by' => null,
            'is_active' => true,
        ];
    }
}
