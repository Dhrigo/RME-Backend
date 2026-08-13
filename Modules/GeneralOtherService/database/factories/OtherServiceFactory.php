<?php

namespace Modules\GeneralOtherService\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralOtherService\Models\OtherService;

class OtherServiceFactory extends Factory
{
    protected $model = OtherService::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->words(3, true),
            'code' => fake()->unique()->lexify('???'),
            'description' => fake()->sentence(),
            'unit' => fake()->randomElement(['per hari', 'per lembar', 'per kali', 'per jam']),
            'is_active' => true,
        ];
    }
}
