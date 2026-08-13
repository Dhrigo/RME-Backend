<?php

namespace Modules\GeneralPackageService\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralPackageService\Models\PackageService;

class PackageServiceFactory extends Factory
{
    protected $model = PackageService::class;

    public function definition(): array
    {
        return [
            'quantity' => fake()->numberBetween(1, 10),
            'is_active' => true,
        ];
    }
}
