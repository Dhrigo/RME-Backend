<?php

namespace Modules\MedicalRecordImageMarker\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordImageMarker\Database\Factories\ImageMarkerFactory;

class ImageMarker extends Model
{
    use HasFactory;

    protected $table = 'image_markers';

    protected $fillable = [
        'visit_id',
        'image_path',
        'template_name',
        'notes',
        'marked_at',
    ];

    protected $casts = [
        'marked_at' => 'datetime',
    ];

    protected static function newFactory(): ImageMarkerFactory
    {
        return ImageMarkerFactory::new();
    }
}
