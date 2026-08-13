<?php

namespace Modules\MedicalRecordEpfraAssessment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordEpfraAssessment\Database\Factories\EpfraAssessmentFactory;

class EpfraAssessment extends Model
{
    use HasFactory;

    protected $table = 'epfra_assessments';

    protected $fillable = [
        'visit_id',
        'assessor_id',
        'criteria_notes',
        'score',
        'risk_level',
        'assessed_at',
    ];

    protected $casts = [
        'assessed_at' => 'datetime',
    ];

    protected static function newFactory(): EpfraAssessmentFactory
    {
        return EpfraAssessmentFactory::new();
    }
}
