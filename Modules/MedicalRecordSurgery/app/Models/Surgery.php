<?php

namespace Modules\MedicalRecordSurgery\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\MedicalRecordDiagnosis\Models\Diagnosis;
use Modules\MedicalRecordSurgery\Database\Factories\SurgeryFactory;
use Modules\PendaftaranVisit\Models\Visit;

class Surgery extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'diagnosis_id',
        'procedure_name',
        'surgeon_id',
        'anesthesia_type',
        'started_at',
        'ended_at',
        'notes',
        'status',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'started_at' => 'datetime',
            'ended_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }

    public function diagnosis(): BelongsTo
    {
        return $this->belongsTo(Diagnosis::class);
    }

    public function surgeon(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'surgeon_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function newFactory(): SurgeryFactory
    {
        return SurgeryFactory::new();
    }
}
