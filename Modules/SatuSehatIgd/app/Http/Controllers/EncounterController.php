<?php

namespace Modules\SatuSehatIgd\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\SatuSehat\Services\SatuSehatClient;
use Modules\SatuSehatIgd\Http\Requests\StoreEncounterRequest;
use Modules\SatuSehatIgd\Http\Resources\SubmissionResource;
use Modules\SatuSehatIgd\Services\IgdEncounterBuilder;

class EncounterController extends Controller
{
    public function __construct(
        private readonly IgdEncounterBuilder $builder,
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
