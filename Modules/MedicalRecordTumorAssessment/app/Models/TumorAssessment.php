<?php

namespace Modules\MedicalRecordTumorAssessment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\MedicalRecordDiagnosis\Models\Diagnosis;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordTumorAssessment\Database\Factories\TumorAssessmentFactory;

class TumorAssessment extends Model
{
    use HasFactory;

    protected $table = 'tumor_assessments';

    protected $fillable = [
        'visit_id',
        'diagnosis_id',
        'assessed_by',
        'created_by',
        'tumor_location',
        'size_cm',
        'tnm_t',
        'tnm_n',
        'tnm_m',
        'grade',
        'notes',
        'assessed_at',
    ];

    protected function casts(): array
    {
        return [
            'size_cm' => 'decimal:2',
            'assessed_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }

    public function diagnosis(): BelongsTo
    {
        return $this->belongsTo(Diagnosis::class, 'diagnosis_id');
    }

    public function assessedBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'assessed_by');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function newFactory(): TumorAssessmentFactory
    {
        return TumorAssessmentFactory::new();
    }
}
