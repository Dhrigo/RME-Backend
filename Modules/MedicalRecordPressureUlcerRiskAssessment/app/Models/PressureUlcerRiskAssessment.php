<?php

namespace Modules\MedicalRecordPressureUlcerRiskAssessment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordPressureUlcerRiskAssessment\Database\Factories\PressureUlcerRiskAssessmentFactory;

class PressureUlcerRiskAssessment extends Model
{
    use HasFactory;

    protected $table = 'pressure_ulcer_risk_assessments';

    protected $fillable = [
        'visit_id',
        'sensory_perception',
        'moisture',
        'activity',
        'mobility',
        'nutrition',
        'friction_shear',
        'total_score',
        'risk_level',
        'assessed_at',
    ];

    protected $casts = [
        'assessed_at' => 'datetime',
    ];

    protected static function newFactory(): PressureUlcerRiskAssessmentFactory
    {
        return PressureUlcerRiskAssessmentFactory::new();
    }
}
