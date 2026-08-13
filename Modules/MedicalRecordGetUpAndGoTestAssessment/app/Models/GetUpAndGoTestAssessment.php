<?php

namespace Modules\MedicalRecordGetUpAndGoTestAssessment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordGetUpAndGoTestAssessment\Database\Factories\GetUpAndGoTestAssessmentFactory;

class GetUpAndGoTestAssessment extends Model
{
    use HasFactory;

    protected $table = 'get_up_and_go_test_assessments';

    protected $fillable = [
        'visit_id',
        'time_seconds',
        'assistive_device',
        'fall_risk',
        'notes',
        'assessed_at',
    ];

    protected $casts = [
        'assessed_at' => 'datetime',
    ];

    protected static function newFactory(): GetUpAndGoTestAssessmentFactory
    {
        return GetUpAndGoTestAssessmentFactory::new();
    }
}
