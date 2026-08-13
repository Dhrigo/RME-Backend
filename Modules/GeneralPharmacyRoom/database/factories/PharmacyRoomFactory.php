<?php

namespace Modules\GeneralPharmacyRoom\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralPharmacyRoom\Models\PharmacyRoom;
use Modules\GeneralWard\Models\Ward;

class PharmacyRoomFactory extends Factory
{
    protected $model = PharmacyRoom::class;

    public function definition(): array
    {
        return [
            'ward_id' => Ward::factory(),
            'pharmacy_type' => fake()->randomElement(['rawat_jalan', 'rawat_inap', 'igd']),
            'is_active' => true,
        ];
    }
}
