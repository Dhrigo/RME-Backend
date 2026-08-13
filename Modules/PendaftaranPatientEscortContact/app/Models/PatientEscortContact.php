<?php

namespace Modules\PendaftaranPatientEscortContact\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\PendaftaranPatientEscort\Models\PatientEscort;
use Modules\PendaftaranPatientEscortContact\Database\Factories\PatientEscortContactFactory;

class PatientEscortContact extends Model
{
    use HasFactory;

    public const CONTACT_TYPES = ['phone', 'mobile', 'whatsapp', 'email'];

    protected $fillable = [
        'patient_escort_id',
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

    public function patientEscort(): BelongsTo
    {
        return $this->belongsTo(PatientEscort::class);
    }

    protected static function newFactory(): PatientEscortContactFactory
    {
        return PatientEscortContactFactory::new();
    }
}
