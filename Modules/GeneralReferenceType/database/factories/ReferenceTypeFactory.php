<?php

namespace Modules\GeneralReferenceType\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralReferenceType\Models\ReferenceType;

class ReferenceTypeFactory extends Factory
{
    protected $model = ReferenceType::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'abbreviation' => fake()->unique()->lexify('????'),
            'is_application' => false,
            'is_active' => true,
        ];
    }
}
