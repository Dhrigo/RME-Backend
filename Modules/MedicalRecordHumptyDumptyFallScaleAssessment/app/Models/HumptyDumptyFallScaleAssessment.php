<?php

namespace Modules\MedicalRecordHumptyDumptyFallScaleAssessment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordHumptyDumptyFallScaleAssessment\Database\Factories\HumptyDumptyFallScaleAssessmentFactory;

class HumptyDumptyFallScaleAssessment extends Model
{
    use HasFactory;

    protected $table = 'humpty_dumpty_fall_scale_assessments';

    protected $fillable = [
        'visit_id',
        'assessed_by',
        'created_by',
        'age_score',
        'gender_score',
        'diagnosis_score',
        'cognitive_impairment_score',
        'environmental_score',
        'surgery_sedation_score',
        'medication_score',
        'total_score',
        'risk_level',
        'assessed_at',
    ];

    protected function casts(): array
    {
        return [
            'assessed_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }

    public function assessedBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'assessed_by');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function newFactory(): HumptyDumptyFallScaleAssessmentFactory
    {
        return HumptyDumptyFallScaleAssessmentFactory::new();
    }
}
