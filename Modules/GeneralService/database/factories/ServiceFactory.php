<?php

namespace Modules\GeneralService\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralService\Models\Service;

class ServiceFactory extends Factory
{
    protected $model = Service::class;

    public function definition(): array
    {
        return [
            'code' => fake()->unique()->bothify('SVC-###'),
            'name' => fake()->unique()->sentence(3),
            'category' => fake()->randomElement(['consultation', 'procedure', 'lab', 'radiology']),
            'type_id' => null,
            'is_active' => true,
        ];
    }
}
