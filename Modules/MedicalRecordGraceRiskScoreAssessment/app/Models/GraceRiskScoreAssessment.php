<?php

namespace Modules\MedicalRecordGraceRiskScoreAssessment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordGraceRiskScoreAssessment\Database\Factories\GraceRiskScoreAssessmentFactory;

class GraceRiskScoreAssessment extends Model
{
    use HasFactory;

    protected $table = 'grace_risk_score_assessments';

    protected $fillable = [
        'visit_id',
        'age',
        'heart_rate',
        'systolic_bp',
        'creatinine_mg_dl',
        'cardiac_arrest_at_admission',
        'st_segment_deviation',
        'elevated_cardiac_enzymes',
        'killip_class',
        'total_score',
        'risk_category',
        'assessed_at',
    ];

    protected $casts = [
        'cardiac_arrest_at_admission' => 'boolean',
        'st_segment_deviation' => 'boolean',
        'elevated_cardiac_enzymes' => 'boolean',
        'assessed_at' => 'datetime',
    ];

    protected static function newFactory(): GraceRiskScoreAssessmentFactory
    {
        return GraceRiskScoreAssessmentFactory::new();
    }
}
