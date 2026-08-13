<?php

namespace Modules\MedicalRecordControlSchedule\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralMedicalDepartment\Models\MedicalDepartment;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordControlSchedule\Database\Factories\ControlScheduleFactory;

class ControlSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'visit_id',
        'medical_department_id',
        'scheduled_date',
        'purpose',
        'scheduled_by',
        'status',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'scheduled_date' => 'date',
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

    public function medicalDepartment(): BelongsTo
    {
        return $this->belongsTo(\Modules\GeneralMedicalDepartment\Models\MedicalDepartment::class);
    }

    public function scheduledBy(): BelongsTo
    {
        return $this->belongsTo(\Modules\GeneralEmployee\Models\Employee::class, 'scheduled_by');
    }

    protected static function newFactory(): ControlScheduleFactory
    {
        return ControlScheduleFactory::new();
    }
}
