<?php

namespace Modules\GeneralVideoAttachment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralVideoAttachment\Models\VideoAttachment;

class VideoAttachmentFactory extends Factory
{
    protected $model = VideoAttachment::class;

    public function definition(): array
    {
        return [
            'patient_id' => \Modules\GeneralPatient\Models\Patient::factory(),
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory(),
            'title' => fake()->words(3, true),
            'file_path' => fake()->words(3, true),
            'mime_type' => fake()->words(3, true),
            'duration_seconds' => fake()->numberBetween(1, 20),
            'recorded_by' => \Modules\Auth\Models\User::factory(),
            'notes' => fake()->paragraph(),
            'is_active' => true,
        ];
    }
}
