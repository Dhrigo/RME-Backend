<?php

namespace Modules\MedicalRecordImageMarkerPoint\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordImageMarkerPoint\Database\Factories\ImageMarkerPointFactory;

class ImageMarkerPoint extends Model
{
    use HasFactory;

    protected $table = 'image_marker_points';

    protected $fillable = [
        'image_marker_id',
        'x_coordinate',
        'y_coordinate',
        'label',
        'description',
    ];


    protected static function newFactory(): ImageMarkerPointFactory
    {
        return ImageMarkerPointFactory::new();
    }
}
