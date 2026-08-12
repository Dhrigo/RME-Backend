<?php

namespace Modules\GeneralLanguage\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralLanguage\Models\Language;

class LanguageFactory extends Factory
{
    protected $model = Language::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'code' => fake()->unique()->lexify('???'),
            'is_active' => true,
        ];
    }
}
