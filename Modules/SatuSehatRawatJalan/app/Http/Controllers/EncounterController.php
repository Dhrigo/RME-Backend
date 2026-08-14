<?php

namespace Modules\SatuSehatRawatJalan\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\SatuSehat\Services\SatuSehatClient;
use Modules\SatuSehatRawatJalan\Http\Requests\StoreEncounterRequest;
use Modules\SatuSehatRawatJalan\Http\Resources\SubmissionResource;
use Modules\SatuSehatRawatJalan\Services\RawatJalanEncounterBuilder;

/**
 * "Pendaftaran Kunjungan Rawat Jalan" - submits the outpatient Encounter
 * resource. Uses the shared SatuSehat kernel client/staging-outbox directly;
 * no local model is needed since the kernel's SatuSehatStagingSubmission
 * already tracks every submission generically.
 */
class EncounterController extends Controller
{
    public function __construct(
        private readonly RawatJalanEncounterBuilder $builder,
        private readonly SatuSehatClient $client,
    ) {
    }

    public function store(StoreEncounterRequest $request)
    {
        $validated = $request->validated();

        $payload = $this->builder->build($validated);

        $submission = $this->client->submit(
            'Encounter',
            $payload,
            self::class,
            crc32($validated['registration_id']),
        );

        return (new SubmissionResource($submission))
            ->response()
            ->setStatusCode($submission->status === 'sent' ? 201 : 422);
    }
}
