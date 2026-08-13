<?php

namespace Modules\PenjaminRSClaimDriver\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PenjaminRSClaimDriver\Models\ClaimDriver;

class ClaimDriverFactory extends Factory
{
    protected $model = ClaimDriver::class;

    public function definition(): array
    {
        return [
            'code' => $this->faker->unique()->lexify('????'),
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(),
            'is_active' => $this->faker->boolean(),
        ];
    }
}
