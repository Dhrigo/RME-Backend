<?php

namespace Modules\MedicalRecordDoctorProcedureConsent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\GeneralDoctor\Models\Doctor;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordDoctorProcedureConsent\Database\Factories\DoctorProcedureConsentFactory;

class DoctorProcedureConsent extends Model
{
    use HasFactory;

    protected $table = 'doctor_procedure_consents';

    protected $fillable = [
        'visit_id',
        'doctor_id',
        'created_by',
        'procedure_name',
        'indication',
        'consent_decision',
        'signed_at',
    ];

    protected function casts(): array
    {
        return [
            'signed_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function newFactory(): DoctorProcedureConsentFactory
    {
        return DoctorProcedureConsentFactory::new();
    }
}
