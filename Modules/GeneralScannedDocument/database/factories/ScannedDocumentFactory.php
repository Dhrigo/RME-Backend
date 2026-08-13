<?php

namespace Modules\GeneralScannedDocument\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ScannedDocumentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\GeneralScannedDocument\Models\ScannedDocument::class;

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

