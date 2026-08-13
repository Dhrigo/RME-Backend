<?php

namespace Modules\GeneralPatientAccessLock\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralPatient\Models\Patient;
use Modules\GeneralPatientAccessLock\Database\Factories\PatientAccessLockFactory;

class PatientAccessLock extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'locked_by',
        'reason',
        'locked_at',
        'unlocked_at',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'locked_at' => 'datetime',
            'unlocked_at' => 'datetime',
            'is_active' => 'boolean',
        ];
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function lockedBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'locked_by');
    }

    protected static function newFactory(): PatientAccessLockFactory
    {
        return PatientAccessLockFactory::new();
    }
}
