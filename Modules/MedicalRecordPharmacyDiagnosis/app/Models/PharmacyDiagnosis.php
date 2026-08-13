<?php

namespace Modules\MedicalRecordPharmacyDiagnosis\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\LayananPrescription\Models\Prescription;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordPharmacyDiagnosis\Database\Factories\PharmacyDiagnosisFactory;

class PharmacyDiagnosis extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'prescription_id',
        'problem_category',
        'description',
        'recommendation',
        'assessed_by',
        'assessed_at',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'assessed_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(\Modules\PendaftaranVisit\Models\Visit::class);
    }

    public function prescription(): BelongsTo
    {
        return $this->belongsTo(\Modules\LayananPrescription\Models\Prescription::class);
    }

    public function assessedBy(): BelongsTo
    {
        return $this->belongsTo(\Modules\GeneralEmployee\Models\Employee::class, 'assessed_by');
    }

    protected static function newFactory(): PharmacyDiagnosisFactory
    {
        return PharmacyDiagnosisFactory::new();
    }
}
