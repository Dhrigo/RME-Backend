<?php

namespace Modules\MedicalRecordImageMarker\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordImageMarker\Models\ImageMarker;

class ImageMarkerFactory extends Factory
{
    protected $model = ImageMarker::class;

    public function definition(): array
    {
        return [
            'visit_id' => 1,
            'image_path' => 'anatomy-templates/body-diagram.png',
            'template_name' => 'Body Diagram - Anterior',
            'notes' => null,
            'marked_at' => now(),
        ];
    }
}
