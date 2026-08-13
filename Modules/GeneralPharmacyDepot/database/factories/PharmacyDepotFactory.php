<?php

namespace Modules\GeneralPharmacyDepot\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralPharmacyDepot\Models\PharmacyDepot;

class PharmacyDepotFactory extends Factory
{
    protected $model = PharmacyDepot::class;

    public function definition(): array
    {
        return [
            'code' => fake()->words(3, true),
            'name' => fake()->words(3, true),
            'ward_id' => \Modules\GeneralWard\Models\Ward::factory(),
            'phone' => fake()->words(3, true),
            'is_active' => true,
        ];
    }
}
