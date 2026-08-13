<?php

namespace Modules\PendaftaranPatientGuardian\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\PendaftaranPatientGuardian\Database\Factories\PatientGuardianFactory;
use Modules\PendaftaranRegistration\Models\Registration;

class PatientGuardian extends Model
{
    use HasFactory;

    public const RELATIONSHIP_TYPES = ['parent', 'spouse', 'child', 'sibling', 'legal_guardian', 'other'];

    protected $fillable = [
        'registration_id',
        'full_name',
        'relationship_to_patient',
        'identity_number',
        'phone_number',
        'address',
        'occupation',
        'created_by',
        'status',
    ];

    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function newFactory(): PatientGuardianFactory
    {
        return PatientGuardianFactory::new();
    }
}
