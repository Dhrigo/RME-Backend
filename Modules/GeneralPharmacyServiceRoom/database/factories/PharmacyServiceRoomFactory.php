<?php

namespace Modules\GeneralPharmacyServiceRoom\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralPharmacyServiceRoom\Models\PharmacyServiceRoom;
use Modules\GeneralWard\Models\Ward;

class PharmacyServiceRoomFactory extends Factory
{
    protected $model = PharmacyServiceRoom::class;

    public function definition(): array
    {
        return [
            'ward_id' => Ward::factory(),
            'service_type' => fake()->randomElement(['rawat_jalan', 'rawat_inap', 'igd', 'one_day_care']),
            'is_active' => true,
        ];
    }
}
