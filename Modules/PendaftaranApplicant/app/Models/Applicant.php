<?php

namespace Modules\PendaftaranApplicant\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\PendaftaranApplicant\Database\Factories\ApplicantFactory;
use Modules\PendaftaranRegistration\Models\Registration;

class Applicant extends Model
{
    use HasFactory;

    public const RELATIONSHIP_TYPES = ['self', 'parent', 'spouse', 'child', 'guardian', 'institution', 'other'];

    public const APPLICATION_TYPES = ['admission', 'referral', 'certificate', 'medical_record_copy', 'other'];

    protected $fillable = [
        'registration_id',
        'full_name',
        'relationship_to_patient',
        'identity_number',
        'phone_number',
        'address',
        'application_type',
        'application_date',
        'notes',
        'created_by',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'application_date' => 'datetime',
        ];
    }

    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function newFactory(): ApplicantFactory
    {
        return ApplicantFactory::new();
    }
}
