<?php

namespace Modules\MedicalRecordDiagnosisIndicatorMapping\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\MedicalRecordDiagnosisIndicatorMapping\Database\Factories\DiagnosisIndicatorMappingFactory;

class DiagnosisIndicatorMapping extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'diagnosis_id',
        'indicator_code',
        'indicator_name',
        'target_score',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function newFactory(): DiagnosisIndicatorMappingFactory
    {
        return DiagnosisIndicatorMappingFactory::new();
    }
}
