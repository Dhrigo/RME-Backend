<?php

namespace Modules\BpjsPCare\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Modules\Bpjs\Services\BpjsClient;
use Modules\BpjsPCare\Concerns\CallsBpjsPCare;
use Modules\BpjsPCare\Http\Requests\StorePendaftaranRequest;
use Modules\BpjsPCare\Http\Requests\UpdatePendaftaranRequest;
use Modules\BpjsPCare\Http\Resources\PendaftaranResource;
use Modules\BpjsPCare\Models\Pendaftaran;

/**
 * Registration (Pendaftaran) precedes Kunjungan in a real PCare workflow -
 * a patient queues/registers first, then the clinical encounter happens.
 * Add/Delete round-trip to BPJS; Get-by-nomor-urut and Get-provider are
 * live BPJS lookups (not served from the local table).
 */
class PendaftaranController extends Controller
{
    use CallsBpjsPCare;

    public function __construct(private readonly BpjsClient $client)
    {
    }

    public function index(): AnonymousResourceCollection
    {
        return PendaftaranResource::collection(Pendaftaran::all());
    }

    public function store(StorePendaftaranRequest $request): PendaftaranResource
    {
        $data = $request->validated();
        $data['status'] = 'menunggu';

        $result = $this->pcareCall($this->client, 'POST', 'pendaftaran', $data);

        $data['bpjs_no_pendaftaran'] = $result['response']->response->noPendaftaran ?? null;
        $data['bpjs_response'] = $result['success'] ? (array) $result['response'] : null;
        $data['bpjs_error'] = $result['error'];

        $pendaftaran = Pendaftaran::create($data);

        return new PendaftaranResource($pendaftaran);
    }

    public function show(Pendaftaran $pendaftaran): PendaftaranResource
    {
        return new PendaftaranResource($pendaftaran);
    }

    public function destroy(Pendaftaran $pendaftaran): Response|JsonResponse
    {
        $result = $this->pcareCall($this->client, 'DELETE', 'pendaftaran/'.$pendaftaran->bpjs_no_pendaftaran);

        if (! $result['success']) {
            $pendaftaran->update(['bpjs_error' => $result['error']]);

            return response()->json(['message' => $result['error']], 422);
        }

        $pendaftaran->delete();

        return response()->noContent();
    }

    /**
     * Get Pendaftaran by Nomor Urut - live BPJS lookup by queue number.
     */
    public function byNomorUrut(Request $request): JsonResponse
    {
        $result = $this->client->call('pcare', 'GET', 'pendaftaran/nomorurut/'.$request->query('nomor_urut'));

        return response()->json($result);
    }

    /**
     * Get Pendaftaran Provider - live BPJS lookup of this provider's queue.
     */
    public function provider(Request $request): JsonResponse
    {
        $result = $this->client->call('pcare', 'GET', 'pendaftaran/provider', $request->query());

        return response()->json($result);
    }
}
