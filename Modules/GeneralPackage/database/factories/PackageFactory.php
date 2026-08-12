<?php

namespace Modules\GeneralPackage\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralPackage\Models\Package;

class PackageFactory extends Factory
{
    protected $model = Package::class;

    public function definition(): array
    {
        return [
            'code' => fake()->unique()->bothify('PKG-###'),
            'name' => fake()->unique()->sentence(3),
            'price' => fake()->randomFloat(2, 100000, 5000000),
            'description' => fake()->sentence(10),
            'is_active' => true,
        ];
    }
}
