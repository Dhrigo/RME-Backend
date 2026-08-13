<?php

namespace Modules\GeneralAdmissionDiagnosis\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralAdmissionDiagnosis\Database\Factories\AdmissionDiagnosisFactory;
use Modules\GeneralDiagnosisCode\Models\DiagnosisCode;
use Modules\PendaftaranVisit\Models\Visit;

class AdmissionDiagnosis extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'diagnosis_code_id',
        'diagnosis_text',
        'is_primary',
        'diagnosed_at',
    ];

    protected function casts(): array
    {
        return [
            'is_primary' => 'boolean',
            'diagnosed_at' => 'datetime',
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

    protected static function newFactory(): AdmissionDiagnosisFactory
    {
        return AdmissionDiagnosisFactory::new();
    }
}
