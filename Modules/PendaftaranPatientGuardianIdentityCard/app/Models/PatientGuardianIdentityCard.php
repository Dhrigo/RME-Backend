<?php

namespace Modules\PendaftaranPatientGuardianIdentityCard\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\PendaftaranPatientGuardian\Models\PatientGuardian;
use Modules\PendaftaranPatientGuardianIdentityCard\Database\Factories\PatientGuardianIdentityCardFactory;

class PatientGuardianIdentityCard extends Model
{
    use HasFactory;

    public const CARD_TYPES = ['KTP', 'KIA', 'Paspor', 'SIM'];

    protected $fillable = [
        'patient_guardian_id',
        'card_type',
        'card_number',
        'issued_date',
        'address',
        'rt',
        'rw',
        'postal_code',
        'region_code',
    ];

    protected function casts(): array
    {
        return [
            'issued_date' => 'date',
        ];
    }

    public function patientGuardian(): BelongsTo
    {
        return $this->belongsTo(PatientGuardian::class);
    }

    protected static function newFactory(): PatientGuardianIdentityCardFactory
    {
        return PatientGuardianIdentityCardFactory::new();
    }
}
