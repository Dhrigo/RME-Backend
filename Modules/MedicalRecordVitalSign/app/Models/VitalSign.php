<?php

namespace Modules\MedicalRecordVitalSign\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\MedicalRecordVitalSign\Database\Factories\VitalSignFactory;
use Modules\PendaftaranVisit\Models\Visit;

class VitalSign extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'recorded_at',
        'temperature',
        'pulse',
        'respiratory_rate',
        'systolic',
        'diastolic',
        'oxygen_saturation',
        'pain_scale',
        'recorded_by',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'recorded_at' => 'datetime',
            'temperature' => 'decimal:1',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }

    public function recordedBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'recorded_by');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function newFactory(): VitalSignFactory
    {
        return VitalSignFactory::new();
    }
}
