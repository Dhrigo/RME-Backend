<?php

namespace Modules\GeneralServiceType\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralServiceType\Models\ServiceType;

class ServiceTypeFactory extends Factory
{
    protected $model = ServiceType::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'code' => fake()->unique()->lexify('???'),
            'is_active' => true,
        ];
    }
}
