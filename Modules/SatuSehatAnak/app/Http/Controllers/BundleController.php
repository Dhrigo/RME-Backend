<?php

namespace Modules\SatuSehatAnak\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\SatuSehat\Services\SatuSehatClient;
use Modules\SatuSehatAnak\Http\Requests\StoreBundleRequest;
use Modules\SatuSehatAnak\Http\Resources\SubmissionResource;

/**
 * One "POST Bundle ..." submission endpoint per Anak use-case
 * (MTBS/Imunisasi/Gizi/Tumbuh Kembang/PKPR/Imunisasi Covid19).
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

    public function mtbs(StoreBundleRequest $request)
    {
        return $this->submit($request, 'MTBS');
    }

    public function imunisasi(StoreBundleRequest $request)
    {
        return $this->submit($request, 'Imunisasi');
    }

    public function gizi(StoreBundleRequest $request)
    {
        return $this->submit($request, 'Gizi');
    }

    public function tumbuhKembang(StoreBundleRequest $request)
    {
        return $this->submit($request, 'TumbuhKembang');
    }

    public function pkpr(StoreBundleRequest $request)
    {
        return $this->submit($request, 'PKPR');
    }

    public function imunisasiCovid19(StoreBundleRequest $request)
    {
        return $this->submit($request, 'ImunisasiCovid19');
    }
}
