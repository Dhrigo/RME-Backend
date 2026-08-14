<?php

namespace Modules\SatuSehatIgd\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\SatuSehat\Services\SatuSehatClient;
use Modules\SatuSehatIgd\Http\Requests\StoreTriageObservationRequest;
use Modules\SatuSehatIgd\Http\Resources\SubmissionResource;
use Modules\SatuSehatIgd\Services\TriageObservationBuilder;

class TriageObservationController extends Controller
{
    public function __construct(
        private readonly TriageObservationBuilder $builder,
        private readonly SatuSehatClient $client,
    ) {
    }

    public function store(StoreTriageObservationRequest $request)
    {
        $validated = $request->validated();

        $payload = $this->builder->build($validated);

        $submission = $this->client->submit(
            'Observation',
            $payload,
            self::class,
            crc32($validated['encounter_id'].'|triage'),
        );

        return (new SubmissionResource($submission))
            ->response()
            ->setStatusCode($submission->status === 'sent' ? 201 : 422);
    }
}
