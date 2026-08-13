<?php

namespace Modules\LayananPatientDeathRecord\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Modules\GeneralEmployee\Models\Employee;
use \Modules\GeneralPatient\Models\Patient;
use \Modules\PendaftaranVisit\Models\Visit;
use Modules\LayananPatientDeathRecord\Database\Factories\PatientDeathRecordFactory;

class PatientDeathRecord extends Model
{
    use HasFactory;

    protected $table = 'patient_death_records';

    protected $fillable = [
        'visit_id',
        'patient_id',
        'died_at',
        'cause_of_death',
        'declared_by',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'died_at' => 'datetime',
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

    public function declaredBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'declared_by');
    }

    protected static function newFactory(): PatientDeathRecordFactory
    {
        return PatientDeathRecordFactory::new();
    }
}
