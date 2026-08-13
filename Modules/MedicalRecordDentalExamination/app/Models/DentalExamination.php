<?php

namespace Modules\MedicalRecordDentalExamination\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\MedicalRecordDentalExamination\Database\Factories\DentalExaminationFactory;

class DentalExamination extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'dental_examinations';

    protected $fillable = [
        'visit_id',
        'decayed_teeth_count',
        'missing_teeth_count',
        'filled_teeth_count',
        'odontogram_json',
        'occlusion_status',
        'notes',
        'examined_at',
    ];

    protected $casts = [
        'decayed_teeth_count' => 'integer',
        'missing_teeth_count' => 'integer',
        'filled_teeth_count' => 'integer',
        'odontogram_json' => 'array',
        'examined_at' => 'datetime',
    ];

    protected static function newFactory(): DentalExaminationFactory
    {
        return DentalExaminationFactory::new();
    }
}
