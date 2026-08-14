<?php

namespace Modules\SatuSehatPenyakitMenular\Services;

use InvalidArgumentException;
use Modules\SatuSehat\Services\SatuSehatClient;
use Modules\SatuSehatPenyakitMenular\Models\PenyakitMenularSubmission;

/**
 * Thin wrapper over the shared Modules\SatuSehat\Services\SatuSehatClient for
 * the 5 Penyakit Menular use-cases (Tuberkulosis, HIV, Rabies/GHPR, Anthrax,
 * SMPK). No HTTP/OAuth2 logic here - every send goes through the kernel's
 * staging-outbox (submit()).
 */
class PenyakitMenularService
{
    public const USE_CASES = ['tuberkulosis', 'hiv', 'rabies', 'anthrax', 'smpk'];

    public function __construct(private readonly SatuSehatClient $client)
    {
    }

    public function submit(string $useCase, string $resourceType, array $payload, ?int $encounterLocalId): PenyakitMenularSubmission
    {
        if (! in_array($useCase, self::USE_CASES, true)) {
            throw new InvalidArgumentException("Unknown Penyakit Menular use-case: {$useCase}");
        }

        $local = PenyakitMenularSubmission::create([
            'encounter_local_id' => $encounterLocalId,
            'use_case' => $useCase,
            'resource_type' => $resourceType,
            'payload' => $payload,
            'status' => 'pending',
        ]);

        $staging = $this->client->submit($resourceType, $payload, 'PenyakitMenularSubmission', $local->id);

        $local->update([
            'satu_sehat_staging_submission_id' => $staging->id,
            'status' => $staging->status,
            'error_message' => $staging->last_error,
        ]);

        return $local->fresh();
    }
}
