<?php

namespace Modules\GeneralOtherServiceTariff\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralOtherService\Models\OtherService;
use Modules\GeneralOtherServiceTariff\Models\OtherServiceTariff;

class OtherServiceTariffFactory extends Factory
{
    protected $model = OtherServiceTariff::class;

    public function definition(): array
    {
        return [
            'other_service_id' => OtherService::factory(),
            'room_class_id' => null,
            'price' => fake()->numberBetween(10000, 500000),
            'effective_date' => fake()->date(),
            'is_active' => true,
        ];
    }
}
