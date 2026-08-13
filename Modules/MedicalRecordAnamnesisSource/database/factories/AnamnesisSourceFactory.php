<?php

namespace Modules\MedicalRecordAnamnesisSource\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordAnamnesis\Models\Anamnesis;
use Modules\MedicalRecordAnamnesisSource\Models\AnamnesisSource;

class AnamnesisSourceFactory extends Factory
{
    protected $model = AnamnesisSource::class;

    public function definition(): array
    {
        return [
            'anamnesis_id' => Anamnesis::factory(),
            'source_type' => fake()->words(3, true),
            'source_name' => fake()->words(2, true),
            'relationship' => fake()->words(3, true),
            'notes' => fake()->sentence(),
        ];
    }
}
