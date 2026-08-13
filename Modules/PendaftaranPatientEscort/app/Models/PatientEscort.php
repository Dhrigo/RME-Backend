<?php

namespace Modules\PendaftaranPatientEscort\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\PendaftaranPatientEscort\Database\Factories\PatientEscortFactory;
use Modules\PendaftaranRegistration\Models\Registration;

class PatientEscort extends Model
{
    use HasFactory;

    public const RELATIONSHIP_TYPES = ['parent', 'spouse', 'child', 'sibling', 'friend', 'institution', 'other'];

    public const ARRIVAL_MODES = ['ambulance', 'private_vehicle', 'public_transport', 'walk_in', 'other'];

    protected $fillable = [
        'registration_id',
        'full_name',
        'relationship_to_patient',
        'phone_number',
        'address',
        'arrival_mode',
        'notes',
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

    protected static function newFactory(): PatientEscortFactory
    {
        return PatientEscortFactory::new();
    }
}
