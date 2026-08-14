<?php

namespace Modules\SatuSehatFarmasi\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\SatuSehat\Services\SatuSehatClient;
use Modules\SatuSehatFarmasi\Http\Requests\StoreMedicationRequestRequest;
use Modules\SatuSehatFarmasi\Http\Resources\SubmissionResource;
use Modules\SatuSehatFarmasi\Services\MedicationRequestBuilder;

class MedicationRequestController extends Controller
{
    public function __construct(
        private readonly MedicationRequestBuilder $builder,
        private readonly SatuSehatClient $client,
    ) {
    }

    public function store(StoreMedicationRequestRequest $request)
    {
        $validated = $request->validated();

        $payload = $this->builder->build($validated);

        $submission = $this->client->submit(
            'MedicationRequest',
            $payload,
            self::class,
            crc32($validated['prescription_number']),
        );

        return (new SubmissionResource($submission))
            ->response()
            ->setStatusCode($submission->status === 'sent' ? 201 : 422);
    }
}
