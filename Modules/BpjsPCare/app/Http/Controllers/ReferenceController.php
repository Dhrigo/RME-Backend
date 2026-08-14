<?php

namespace Modules\BpjsPCare\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Bpjs\Services\BpjsClient;

/**
 * Thin passthrough for PCare's pure reference/lookup categories - BPJS is
 * queried live on every call, nothing is persisted locally (these are BPJS's
 * master data, not this hospital's records).
 *
 * NOTE: exact URI paths below are our best-effort guess following BPJS's
 * documented REST conventions (mirrors the "referensi/*" shape used by
 * VClaim's reference endpoints). Not verified against BPJS's official PCare
 * Postman collection - flagged for human review before go-live.
 */
class ReferenceController extends Controller
{
    public function __construct(private readonly BpjsClient $client)
    {
    }

    public function diagnosa(Request $request): JsonResponse
    {
        return $this->passthrough('referensi/diagnosa', $request);
    }

    public function dokter(Request $request): JsonResponse
    {
        return $this->passthrough('referensi/dokter', $request);
    }

    public function kelompok(Request $request): JsonResponse
    {
        return $this->passthrough('referensi/kelompok', $request);
    }

    public function kesadaran(Request $request): JsonResponse
    {
        return $this->passthrough('referensi/kesadaran', $request);
    }

    public function obat(Request $request): JsonResponse
    {
        return $this->passthrough('referensi/obat', $request);
    }

    public function poli(Request $request): JsonResponse
    {
        return $this->passthrough('referensi/poli', $request);
    }

    public function provider(Request $request): JsonResponse
    {
        return $this->passthrough('referensi/provider', $request);
    }

    public function spesialis(Request $request): JsonResponse
    {
        return $this->passthrough('referensi/spesialis', $request);
    }

    public function statusPulang(Request $request): JsonResponse
    {
        return $this->passthrough('referensi/statuspulang', $request);
    }

    /**
     * Peserta lookup - grouped with the transactional entities in the spec
     * ("likely Get/lookup pattern similar to VClaim's Peserta") but behaves
     * exactly like a reference lookup: query BPJS, return directly, nothing
     * persisted locally.
     */
    public function peserta(Request $request): JsonResponse
    {
        return $this->passthrough('peserta', $request);
    }

    private function passthrough(string $uri, Request $request): JsonResponse
    {
        $result = $this->client->call('pcare', 'GET', $uri, $request->query());

        return response()->json($result);
    }
}
