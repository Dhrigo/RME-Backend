<?php

namespace Modules\SatuSehatKlaim\Services;

use InvalidArgumentException;
use Modules\SatuSehat\Services\SatuSehatClient;
use Modules\SatuSehatKlaim\Models\KlaimSubmission;

/**
 * Thin wrapper over the shared Modules\SatuSehat\Services\SatuSehatClient for
 * the Modul Klaim use-cases (Klaim Swasta Primary/Secondary/TPA/OOP payor,
 * Klaim BPJS-K, Rujukan Pasien). No HTTP/OAuth2 logic here - every send goes
 * through the kernel's staging-outbox (submit()).
 */
class KlaimService
{
    public const USE_CASES = [
        'swasta_primary_payor',
        'swasta_secondary_payor',
        'swasta_tpa',
        'swasta_oop',
        'bpjsk',
        'rujukan_pasien',
    ];

    public function __construct(private readonly SatuSehatClient $client)
    {
    }

    public function submit(string $useCase, string $resourceType, array $payload, ?int $encounterLocalId): KlaimSubmission
    {
        if (! in_array($useCase, self::USE_CASES, true)) {
            throw new InvalidArgumentException("Unknown Klaim use-case: {$useCase}");
        }

        $local = KlaimSubmission::create([
            'encounter_local_id' => $encounterLocalId,
            'use_case' => $useCase,
            'resource_type' => $resourceType,
            'payload' => $payload,
            'status' => 'pending',
        ]);

        $staging = $this->client->submit($resourceType, $payload, 'KlaimSubmission', $local->id);

        $local->update([
            'satu_sehat_staging_submission_id' => $staging->id,
            'status' => $staging->status,
            'error_message' => $staging->last_error,
        ]);

        return $local->fresh();
    }
}
