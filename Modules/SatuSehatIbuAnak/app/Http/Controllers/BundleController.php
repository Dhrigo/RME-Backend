<?php

namespace Modules\SatuSehatIbuAnak\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\SatuSehat\Services\SatuSehatClient;
use Modules\SatuSehatIbuAnak\Http\Requests\StoreBundleRequest;
use Modules\SatuSehatIbuAnak\Http\Resources\SubmissionResource;

/**
 * One "POST Bundle ..." submission endpoint per Ibu & Anak use-case
 * (ANC/INC/PNC/Neonatus/SHK/Kematian Maternal/Data Kelahiran), all sharing
 * the same generic Bundle-passthrough submission logic - see
 * StoreBundleRequest for why the internal resource fields are not
 * individually reconstructed. No local model: the kernel's
 * SatuSehatStagingSubmission already tracks every submission, tagged here
 * per use-case via the $sourceType string for later filtering/audit.
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

    public function anc(StoreBundleRequest $request)
    {
        return $this->submit($request, 'ANC');
    }

    public function inc(StoreBundleRequest $request)
    {
        return $this->submit($request, 'INC');
    }

    public function pnc(StoreBundleRequest $request)
    {
        return $this->submit($request, 'PNC');
    }

    public function neonatus(StoreBundleRequest $request)
    {
        return $this->submit($request, 'Neonatus');
    }

    public function shk(StoreBundleRequest $request)
    {
        return $this->submit($request, 'SHK');
    }

    public function kematianMaternal(StoreBundleRequest $request)
    {
        return $this->submit($request, 'KematianMaternal');
    }

    public function dataKelahiran(StoreBundleRequest $request)
    {
        return $this->submit($request, 'DataKelahiran');
    }
}
