<?php

namespace Modules\MedicalRecordDifferentialDiagnosis\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralDiagnosisCode\Models\DiagnosisCode;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordDifferentialDiagnosis\Database\Factories\DifferentialDiagnosisFactory;

class DifferentialDiagnosis extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'diagnosis_code_id',
        'description',
        'rank',
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

    public function diagnosisCode(): BelongsTo
    {
        return $this->belongsTo(\Modules\GeneralDiagnosisCode\Models\DiagnosisCode::class);
    }

    public function recordedBy(): BelongsTo
    {
        return $this->belongsTo(\Modules\GeneralEmployee\Models\Employee::class, 'recorded_by');
    }

    protected static function newFactory(): DifferentialDiagnosisFactory
    {
        return DifferentialDiagnosisFactory::new();
    }
}
