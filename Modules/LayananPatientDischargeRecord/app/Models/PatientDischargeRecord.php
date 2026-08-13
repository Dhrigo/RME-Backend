<?php

namespace Modules\LayananPatientDischargeRecord\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Modules\GeneralEmployee\Models\Employee;
use \Modules\GeneralPatient\Models\Patient;
use \Modules\PendaftaranVisit\Models\Visit;
use Modules\LayananPatientDischargeRecord\Database\Factories\PatientDischargeRecordFactory;

class PatientDischargeRecord extends Model
{
    use HasFactory;

    protected $table = 'patient_discharge_records';

    public const DISCHARGE_METHODS = ['healed', 'improved', 'against_medical_advice', 'referred', 'died'];

    protected $fillable = [
        'visit_id',
        'patient_id',
        'discharged_at',
        'discharge_method',
        'discharged_by',
        'follow_up_notes',
    ];

    protected function casts(): array
    {
        return [
            'discharged_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function dischargedBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'discharged_by');
    }

    protected static function newFactory(): PatientDischargeRecordFactory
    {
        return PatientDischargeRecordFactory::new();
    }
}
