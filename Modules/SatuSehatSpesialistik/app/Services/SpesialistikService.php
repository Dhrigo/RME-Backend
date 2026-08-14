<?php

namespace Modules\SatuSehatSpesialistik\Services;

use InvalidArgumentException;
use Modules\SatuSehat\Services\SatuSehatClient;
use Modules\SatuSehatSpesialistik\Models\SpesialistikSubmission;

/**
 * Thin wrapper over the shared Modules\SatuSehat\Services\SatuSehatClient for the
 * 5 Registrasi Spesialistik use-cases grouped into this module (Gigi/Odontogram,
 * Mata, Telinga, Geriatri, UBM). No HTTP/OAuth2 logic here - every send goes
 * through the kernel's staging-outbox (submit()) so failures are retried by the
 * kernel's RetrySatuSehatSubmissions command, not reimplemented per module.
 */
class SpesialistikService
{
    public const USE_CASES = ['gigi', 'mata', 'telinga', 'geriatri', 'ubm'];

    public function __construct(private readonly SatuSehatClient $client)
    {
    }

    public function submit(string $useCase, string $resourceType, array $payload, ?int $encounterLocalId): SpesialistikSubmission
    {
        if (! in_array($useCase, self::USE_CASES, true)) {
            throw new InvalidArgumentException("Unknown Spesialistik use-case: {$useCase}");
        }

        $local = SpesialistikSubmission::create([
            'encounter_local_id' => $encounterLocalId,
            'use_case' => $useCase,
            'resource_type' => $resourceType,
            'payload' => $payload,
            'status' => 'pending',
        ]);

        $staging = $this->client->submit($resourceType, $payload, 'SpesialistikSubmission', $local->id);

        $local->update([
            'satu_sehat_staging_submission_id' => $staging->id,
            'status' => $staging->status,
            'error_message' => $staging->last_error,
        ]);

        return $local->fresh();
    }
}
