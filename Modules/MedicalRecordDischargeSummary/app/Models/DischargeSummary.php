<?php

namespace Modules\MedicalRecordDischargeSummary\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\MedicalRecordDiagnosis\Models\Diagnosis;
use Modules\MedicalRecordDischargeSummary\Database\Factories\DischargeSummaryFactory;
use Modules\PendaftaranVisit\Models\Visit;

class DischargeSummary extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'admission_diagnosis_id',
        'discharge_diagnosis_id',
        'treatment_summary',
        'condition_at_discharge',
        'follow_up_plan',
        'discharge_medication',
        'authored_by',
        'authored_at',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'authored_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }

    public function admissionDiagnosis(): BelongsTo
    {
        return $this->belongsTo(Diagnosis::class, 'admission_diagnosis_id');
    }

    public function dischargeDiagnosis(): BelongsTo
    {
        return $this->belongsTo(Diagnosis::class, 'discharge_diagnosis_id');
    }

    public function authoredBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'authored_by');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function newFactory(): DischargeSummaryFactory
    {
        return DischargeSummaryFactory::new();
    }
}
