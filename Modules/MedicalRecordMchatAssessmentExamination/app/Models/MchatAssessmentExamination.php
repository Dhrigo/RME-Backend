<?php

namespace Modules\MedicalRecordMchatAssessmentExamination\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\MedicalRecordMchatAssessmentExamination\Database\Factories\MchatAssessmentExaminationFactory;

class MchatAssessmentExamination extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'mchat_assessment_examinations';

    protected $fillable = [
        'visit_id',
        'patient_id',
        'total_score',
        'risk_level',
        'responses_json',
        'recommendation',
        'assessed_at',
    ];

    protected $casts = [
        'total_score' => 'integer',
        'responses_json' => 'array',
        'assessed_at' => 'datetime',
    ];

    protected static function newFactory(): MchatAssessmentExaminationFactory
    {
        return MchatAssessmentExaminationFactory::new();
    }
}
