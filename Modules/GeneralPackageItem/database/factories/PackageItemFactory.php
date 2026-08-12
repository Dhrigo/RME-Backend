<?php

namespace Modules\GeneralPackageItem\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralPackageItem\Models\PackageItem;

class PackageItemFactory extends Factory
{
    protected $model = PackageItem::class;

    public function definition(): array
    {
        return [
            'quantity' => fake()->numberBetween(1, 10),
            'is_active' => true,
        ];
    }
}
