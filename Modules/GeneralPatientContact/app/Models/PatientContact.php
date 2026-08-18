<?php

namespace Modules\GeneralPatientContact\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralPatient\Models\Patient;
use Modules\GeneralPatientContact\Database\Factories\PatientContactFactory;

class PatientContact extends Model
{
    use HasFactory;

    public const CONTACT_TYPES = ['telepon_rumah', 'telepon_kantor', 'telepon_seluler', 'faks_rumah', 'faks_kantor', 'email', 'situs_web', 'media_sosial'];

    protected $fillable = [
        'patient_id',
        'contact_type',
        'contact_value',
        'is_primary',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_primary' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    protected static function newFactory(): PatientContactFactory
    {
        return PatientContactFactory::new();
    }
}
