<?php

namespace Modules\MedicalRecordMedicalCheckupResult\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordMedicalCheckupResult\Database\Factories\MedicalCheckupResultFactory;

class MedicalCheckupResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'visit_id',
        'checkup_date',
        'category',
        'summary',
        'recommendation',
        'examined_by',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'checkup_date' => 'date',
        ];
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(\Modules\GeneralPatient\Models\Patient::class);
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(\Modules\PendaftaranVisit\Models\Visit::class);
    }

    public function examinedBy(): BelongsTo
    {
        return $this->belongsTo(\Modules\GeneralEmployee\Models\Employee::class, 'examined_by');
    }

    protected static function newFactory(): MedicalCheckupResultFactory
    {
        return MedicalCheckupResultFactory::new();
    }
}
