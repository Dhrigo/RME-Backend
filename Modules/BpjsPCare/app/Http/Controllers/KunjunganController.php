<?php

namespace Modules\BpjsPCare\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Modules\Bpjs\Services\BpjsClient;
use Modules\BpjsPCare\Concerns\CallsBpjsPCare;
use Modules\BpjsPCare\Http\Requests\StoreKunjunganRequest;
use Modules\BpjsPCare\Http\Requests\UpdateKunjunganRequest;
use Modules\BpjsPCare\Http\Resources\KunjunganResource;
use Modules\BpjsPCare\Models\Kunjungan;

/**
 * Kunjungan (visit/encounter) is the core PCare record and the parent for
 * MCU/Alergi/Prognosa/Skrinning/Tindakan captured during the same visit.
 */
class KunjunganController extends Controller
{
    use CallsBpjsPCare;

    public function __construct(private readonly BpjsClient $client)
    {
    }

    public function index(): AnonymousResourceCollection
    {
        return KunjunganResource::collection(Kunjungan::all());
    }

    public function store(StoreKunjunganRequest $request): KunjunganResource
    {
        $data = $request->validated();
        $data['jenis_kunjungan'] = $data['jenis_kunjungan'] ?? 'baru';

        $result = $this->pcareCall($this->client, 'POST', 'kunjungan', $data);

        $data['nomor_kunjungan'] = $result['response']->response->noKunjungan ?? null;
        $data['bpjs_response'] = $result['success'] ? (array) $result['response'] : null;
        $data['bpjs_error'] = $result['error'];

        $kunjungan = Kunjungan::create($data);

        return new KunjunganResource($kunjungan);
    }

    public function show(Kunjungan $kunjungan): KunjunganResource
    {
        return new KunjunganResource($kunjungan);
    }

    public function update(UpdateKunjunganRequest $request, Kunjungan $kunjungan): KunjunganResource
    {
        $data = $request->validated();

        $result = $this->pcareCall($this->client, 'PUT', 'kunjungan', array_merge(
            ['noKunjungan' => $kunjungan->nomor_kunjungan],
            $data,
        ));

        $data['bpjs_response'] = $result['success'] ? (array) $result['response'] : $kunjungan->bpjs_response;
        $data['bpjs_error'] = $result['error'];

        $kunjungan->update($data);

        return new KunjunganResource($kunjungan);
    }

    public function destroy(Kunjungan $kunjungan): Response|JsonResponse
    {
        $result = $this->pcareCall($this->client, 'DELETE', 'kunjungan/'.$kunjungan->nomor_kunjungan);

        if (! $result['success']) {
            $kunjungan->update(['bpjs_error' => $result['error']]);

            return response()->json(['message' => $result['error']], 422);
        }

        $kunjungan->delete();

        return response()->noContent();
    }

    /**
     * Get Rujukan - live BPJS referral lookup, used to prefill a new
     * Kunjungan (no_rujukan) before it's created locally.
     */
    public function rujukan(Request $request): JsonResponse
    {
        $result = $this->client->call('pcare', 'GET', 'kunjungan/rujukan', $request->query());

        return response()->json($result);
    }

    /**
     * Get Riwayat Kunjungan - live BPJS visit-history lookup by no_kartu,
     * spans all providers (not just this hospital's local table).
     */
    public function riwayat(Request $request): JsonResponse
    {
        $result = $this->client->call('pcare', 'GET', 'kunjungan/riwayat', $request->query());

        return response()->json($result);
    }
}
