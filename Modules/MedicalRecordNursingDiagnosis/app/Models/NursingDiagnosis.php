<?php

namespace Modules\MedicalRecordNursingDiagnosis\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordNursingDiagnosis\Database\Factories\NursingDiagnosisFactory;

class NursingDiagnosis extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'diagnosis_label',
        'related_factors',
        'defining_characteristics',
        'priority',
        'recorded_by',
        'recorded_at',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'recorded_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(\Modules\PendaftaranVisit\Models\Visit::class);
    }

    public function recordedBy(): BelongsTo
    {
        return $this->belongsTo(\Modules\GeneralEmployee\Models\Employee::class, 'recorded_by');
    }

    protected static function newFactory(): NursingDiagnosisFactory
    {
        return NursingDiagnosisFactory::new();
    }
}
