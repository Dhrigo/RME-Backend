<?php

namespace Modules\MedicalRecordCaseManagerAssessment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordCaseManagerAssessment\Database\Factories\CaseManagerAssessmentFactory;

class CaseManagerAssessment extends Model
{
    use HasFactory;

    protected $table = 'case_manager_assessments';

    protected $fillable = [
        'visit_id',
        'case_manager_id',
        'screening_criteria',
        'risk_level',
        'care_plan',
        'follow_up_needed',
        'assessed_at',
    ];

    protected $casts = [
        'follow_up_needed' => 'boolean',
        'assessed_at' => 'datetime',
    ];

    protected static function newFactory(): CaseManagerAssessmentFactory
    {
        return CaseManagerAssessmentFactory::new();
    }
}
