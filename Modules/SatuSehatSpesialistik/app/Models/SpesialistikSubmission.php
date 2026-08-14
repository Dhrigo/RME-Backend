<?php

namespace Modules\SatuSehatSpesialistik\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\SatuSehat\Models\SatuSehatStagingSubmission;
use Modules\SatuSehatSpesialistik\Database\Factories\SpesialistikSubmissionFactory;

/**
 * Local ledger of Registrasi Spesialistik submissions made through this module
 * (Gigi/Odontogram, Mata, Telinga, Geriatri, UBM - Postman collections 24, 31,
 * 32, 42, 43). Each row records which use-case/resourceType was submitted for
 * which local encounter and links to the kernel's staging-outbox row so send
 * status/retries are tracked in one place (Modules\SatuSehat\Models\SatuSehatStagingSubmission).
 */
class SpesialistikSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'encounter_local_id',
        'use_case',
        'resource_type',
        'payload',
        'satu_sehat_staging_submission_id',
        'status',
        'error_message',
    ];

    protected function casts(): array
    {
        return [
            'payload' => 'array',
        ];
    }

    public function stagingSubmission(): BelongsTo
    {
        return $this->belongsTo(SatuSehatStagingSubmission::class, 'satu_sehat_staging_submission_id');
    }

    protected static function newFactory(): SpesialistikSubmissionFactory
    {
        return SpesialistikSubmissionFactory::new();
    }
}
