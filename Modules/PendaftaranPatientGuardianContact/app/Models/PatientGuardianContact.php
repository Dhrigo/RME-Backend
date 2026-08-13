<?php

namespace Modules\PendaftaranPatientGuardianContact\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\PendaftaranPatientGuardian\Models\PatientGuardian;
use Modules\PendaftaranPatientGuardianContact\Database\Factories\PatientGuardianContactFactory;

class PatientGuardianContact extends Model
{
    use HasFactory;

    public const CONTACT_TYPES = ['phone', 'mobile', 'whatsapp', 'email'];

    protected $fillable = [
        'patient_guardian_id',
        'contact_type',
        'contact_value',
        'is_primary',
    ];

    protected function casts(): array
    {
        return [
            'is_primary' => 'boolean',
        ];
    }

    public function patientGuardian(): BelongsTo
    {
        return $this->belongsTo(PatientGuardian::class);
    }

    protected static function newFactory(): PatientGuardianContactFactory
    {
        return PatientGuardianContactFactory::new();
    }
}
