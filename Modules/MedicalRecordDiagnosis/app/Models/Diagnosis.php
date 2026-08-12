<?php

namespace Modules\MedicalRecordDiagnosis\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\GeneralDiagnosisCode\Models\DiagnosisCode;
use Modules\MedicalRecordDiagnosis\Database\Factories\DiagnosisFactory;
use Modules\PendaftaranVisit\Models\Visit;

class Diagnosis extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'diagnosis_code_id',
        'is_primary',
        'recorded_at',
        'recorded_by',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'is_primary' => 'boolean',
            'recorded_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }

    public function diagnosisCode(): BelongsTo
    {
        return $this->belongsTo(DiagnosisCode::class);
    }

    public function recordedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }

    protected static function newFactory(): DiagnosisFactory
    {
        return DiagnosisFactory::new();
    }
}
