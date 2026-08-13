<?php

namespace Modules\MedicalRecordImageMarkerPoint\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordImageMarker\Models\ImageMarker;
use Modules\MedicalRecordImageMarkerPoint\Models\ImageMarkerPoint;

class ImageMarkerPointFactory extends Factory
{
    protected $model = ImageMarkerPoint::class;

    public function definition(): array
    {
        return [
            'image_marker_id' => ImageMarker::factory(),
            'x_coordinate' => 120.50,
            'y_coordinate' => 80.25,
            'label' => 'Laceration',
            'description' => null,
        ];
    }
}
