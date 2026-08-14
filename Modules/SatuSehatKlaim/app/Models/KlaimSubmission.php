<?php

namespace Modules\SatuSehatKlaim\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\SatuSehat\Models\SatuSehatStagingSubmission;
use Modules\SatuSehatKlaim\Database\Factories\KlaimSubmissionFactory;

/**
 * Local ledger of Modul Klaim submissions sent through this module to
 * SATUSEHAT: Klaim Swasta (Primary Payor/Secondary Payor/TPA/OOP - Postman
 * collection 25), Klaim BPJS-K (collection 26), and Rujukan Pasien
 * (collection 30, interop with BPJS FHIR + SISRUTE data pendukung).
 */
class KlaimSubmission extends Model
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

    protected static function newFactory(): KlaimSubmissionFactory
    {
        return KlaimSubmissionFactory::new();
    }
}
