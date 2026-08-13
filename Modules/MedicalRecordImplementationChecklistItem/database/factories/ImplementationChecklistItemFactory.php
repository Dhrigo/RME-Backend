<?php

namespace Modules\MedicalRecordImplementationChecklistItem\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordImplementationChecklistItem\Models\ImplementationChecklistItem;

class ImplementationChecklistItemFactory extends Factory
{
    protected $model = ImplementationChecklistItem::class;

    public function definition(): array
    {
        return [
            'code' => strtoupper(fake()->bothify('??##')),
            'name' => fake()->words(2, true),
            'category' => fake()->words(3, true),
            'description' => fake()->sentence(),
            'is_active' => true,
        ];
    }
}
