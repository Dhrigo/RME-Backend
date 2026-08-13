<?php

namespace Modules\MedicalRecordPhysicalAssessment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordPhysicalAssessment\Database\Factories\PhysicalAssessmentFactory;

class PhysicalAssessment extends Model
{
    use HasFactory;

    protected $table = 'physical_assessments';

    protected $fillable = [
        'visit_id',
        'mobility_status',
        'adl_status',
        'cognitive_status',
        'nutritional_risk',
        'pain_level',
        'notes',
        'assessed_at',
    ];

    protected $casts = [
        'assessed_at' => 'datetime',
    ];

    protected static function newFactory(): PhysicalAssessmentFactory
    {
        return PhysicalAssessmentFactory::new();
    }
}
