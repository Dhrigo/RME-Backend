<?php

namespace Modules\InventoryPharmacyPackage\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\InventoryPharmacyPackage\Models\PharmacyPackage;

class PharmacyPackageFactory extends Factory
{
    protected $model = PharmacyPackage::class;

    public function definition(): array
    {
        return [
            'package_code' => 'PKF-'.fake()->unique()->numerify('#####'),
            'name' => 'Paket '.fake()->randomElement(['Luka Ringan', 'Perawatan Diabetes', 'Nebulizer', 'Post Operasi']),
            'pharmacy_service_room_id' => null,
            'category' => fake()->randomElement(['obat', 'alkes', 'campuran']),
            'price' => fake()->randomFloat(2, 50000, 2000000),
            'description' => fake()->sentence(),
            'is_active' => true,
        ];
    }
}
