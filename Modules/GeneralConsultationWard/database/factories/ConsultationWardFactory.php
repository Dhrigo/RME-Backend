<?php

namespace Modules\GeneralConsultationWard\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ConsultationWardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\GeneralConsultationWard\Models\ConsultationWard::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'is_active' => fake()->boolean(90),
        ];
    }
}

