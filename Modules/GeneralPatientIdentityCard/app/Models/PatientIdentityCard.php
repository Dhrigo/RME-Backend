<?php

namespace Modules\GeneralPatientIdentityCard\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralPatient\Models\Patient;
use Modules\GeneralPatientIdentityCard\Database\Factories\PatientIdentityCardFactory;

class PatientIdentityCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'id_type',
        'id_number',
        'issued_at',
    ];

    protected function casts(): array
    {
        return [
            'issued_at' => 'date',
        ];
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    protected static function newFactory(): PatientIdentityCardFactory
    {
        return PatientIdentityCardFactory::new();
    }
}
