<?php

namespace Modules\GeneralPharmacyTariffByRoomClass\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralPharmacyTariffByRoomClass\Models\PharmacyTariffByRoomClass;

class PharmacyTariffByRoomClassFactory extends Factory
{
    protected $model = PharmacyTariffByRoomClass::class;

    public function definition(): array
    {
        return [
            'price' => fake()->randomFloat(2, 10, 1000),
            'effective_date' => fake()->date(),
            'is_active' => true,
        ];
    }
}
