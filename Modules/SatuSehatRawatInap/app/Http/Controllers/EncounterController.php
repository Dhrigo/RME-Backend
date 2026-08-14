<?php

namespace Modules\SatuSehatRawatInap\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\SatuSehat\Services\SatuSehatClient;
use Modules\SatuSehatRawatInap\Http\Requests\StoreEncounterRequest;
use Modules\SatuSehatRawatInap\Http\Resources\SubmissionResource;
use Modules\SatuSehatRawatInap\Services\RawatInapEncounterBuilder;

/**
 * "Pendaftaran Kunjungan Rawat Inap" - submits the inpatient admission
 * Encounter resource (class.code=IMP).
 */
class EncounterController extends Controller
{
    public function __construct(
        private readonly RawatInapEncounterBuilder $builder,
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
