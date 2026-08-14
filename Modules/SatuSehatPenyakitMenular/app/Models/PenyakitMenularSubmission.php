<?php

namespace Modules\SatuSehatPenyakitMenular\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\SatuSehat\Models\SatuSehatStagingSubmission;
use Modules\SatuSehatPenyakitMenular\Database\Factories\PenyakitMenularSubmissionFactory;

/**
 * Local ledger of Penyakit Menular use-case submissions sent through this
 * module to SATUSEHAT (Tuberkulosis, HIV, Rabies/GHPR, Anthrax, SMPK -
 * Postman collections 34, 36, 46, 47, 48). This is the national interop
 * reporting channel via SATUSEHAT and is DISTINCT from the separate `Sitb`
 * module, which pushes patient data directly to the standalone SITB system -
 * they are two different destinations for TB data, not duplicates.
 */
class PenyakitMenularSubmission extends Model
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

    protected static function newFactory(): PenyakitMenularSubmissionFactory
    {
        return PenyakitMenularSubmissionFactory::new();
    }
}
