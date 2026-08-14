<?php

namespace Modules\SatuSehatPtmRegistry\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\SatuSehat\Services\SatuSehatClient;
use Modules\SatuSehatPtmRegistry\Http\Requests\StoreBundleRequest;
use Modules\SatuSehatPtmRegistry\Http\Resources\SubmissionResource;

/**
 * One submission endpoint per PTM registry use-case (Skrining PTM/Kanker/
 * Jantung/Stroke/Uronefrologi).
 */
class BundleController extends Controller
{
    public function __construct(private readonly SatuSehatClient $client)
    {
    }

    private function submit(StoreBundleRequest $request, string $useCase)
    {
        $bundle = $request->validated();

        $sourceId = crc32($useCase.'|'.json_encode($bundle['identifier'] ?? $bundle['entry']));

        $submission = $this->client->submit('Bundle', $bundle, self::class.':'.$useCase, $sourceId);

        return (new SubmissionResource($submission))
            ->response()
            ->setStatusCode($submission->status === 'sent' ? 201 : 422);
    }

    public function skriningPtm(StoreBundleRequest $request)
    {
        return $this->submit($request, 'SkriningPTM');
    }

    public function kanker(StoreBundleRequest $request)
    {
        return $this->submit($request, 'Kanker');
    }

    public function jantung(StoreBundleRequest $request)
    {
        return $this->submit($request, 'Jantung');
    }

    public function stroke(StoreBundleRequest $request)
    {
        return $this->submit($request, 'Stroke');
    }

    public function uronefrologi(StoreBundleRequest $request)
    {
        return $this->submit($request, 'Uronefrologi');
    }
}
