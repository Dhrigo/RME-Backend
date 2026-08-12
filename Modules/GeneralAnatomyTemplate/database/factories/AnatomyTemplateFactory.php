<?php

namespace Modules\GeneralAnatomyTemplate\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralAnatomyTemplate\Models\AnatomyTemplate;

class AnatomyTemplateFactory extends Factory
{
    protected $model = AnatomyTemplate::class;

    public function definition(): array
    {
        return [
            'code' => fake()->unique()->lexify('???'),
            'name' => fake()->unique()->words(3, true),
            'is_active' => true,
        ];
    }
}
