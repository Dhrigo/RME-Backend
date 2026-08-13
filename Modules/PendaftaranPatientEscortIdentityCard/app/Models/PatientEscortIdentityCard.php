<?php

namespace Modules\PendaftaranPatientEscortIdentityCard\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\PendaftaranPatientEscort\Models\PatientEscort;
use Modules\PendaftaranPatientEscortIdentityCard\Database\Factories\PatientEscortIdentityCardFactory;

class PatientEscortIdentityCard extends Model
{
    use HasFactory;

    public const CARD_TYPES = ['KTP', 'KIA', 'Paspor', 'SIM'];

    protected $fillable = [
        'patient_escort_id',
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

    public function patientEscort(): BelongsTo
    {
        return $this->belongsTo(PatientEscort::class);
    }

    protected static function newFactory(): PatientEscortIdentityCardFactory
    {
        return PatientEscortIdentityCardFactory::new();
    }
}
