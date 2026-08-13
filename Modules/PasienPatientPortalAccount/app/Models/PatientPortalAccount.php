<?php

namespace Modules\PasienPatientPortalAccount\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Modules\GeneralPatient\Models\Patient;
use Modules\PasienPatientPortalAccount\Database\Factories\PatientPortalAccountFactory;

class PatientPortalAccount extends Model
{
    use HasFactory;

    protected $table = 'patient_portal_accounts';

    protected $fillable = [
        'patient_id',
        'username',
        'email',
        'phone',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    protected static function newFactory(): PatientPortalAccountFactory
    {
        return PatientPortalAccountFactory::new();
    }
}
