<?php

namespace Modules\InventorySupplier\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\InventorySupplier\Models\Supplier;

class SupplierFactory extends Factory
{
    protected $model = Supplier::class;

    public function definition(): array
    {
        return [
            'code' => fake()->unique()->bothify('SUP-###'),
            'name' => fake()->unique()->company(),
            'contact_person' => fake()->name(),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->unique()->companyEmail(),
            'address' => fake()->address(),
            'is_active' => true,
        ];
    }
}
