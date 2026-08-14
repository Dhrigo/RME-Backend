<?php

namespace Modules\BpjsVClaim\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\BpjsVClaim\Http\Requests\StoreRencanaKontrolRequest;
use Modules\BpjsVClaim\Http\Requests\UpdateRencanaKontrolRequest;
use Modules\BpjsVClaim\Http\Resources\RencanaKontrolResource;
use Modules\BpjsVClaim\Models\RencanaKontrol;
use Modules\BpjsVClaim\Services\VClaimService;
use Modules\BpjsVClaim\Support\RecordsBpjsResult;
use Modules\GeneralDoctor\Models\Doctor;

class RencanaKontrolController extends Controller
{
    use RecordsBpjsResult;

    public function __construct(private readonly VClaimService $vclaim)
    {
    }

    public function index(Request $request)
    {
        $query = RencanaKontrol::query();
        if ($request->filled('sep_id')) {
            $query->where('sep_id', $request->integer('sep_id'));
        }

        return RencanaKontrolResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreRencanaKontrolRequest $request)
    {
        $rencanaKontrol = RencanaKontrol::create($request->validated() + ['local_status' => 'draft']);
        $rencanaKontrol->load('sep');

        $bpjsResponse = $this->vclaim->insertRencanaKontrol($this->buildPayload($rencanaKontrol));
        $this->applyResult($rencanaKontrol, $bpjsResponse);

        return (new RencanaKontrolResource($rencanaKontrol->fresh()))->response()->setStatusCode(201);
    }

    public function show(RencanaKontrol $rencanaKontrol): RencanaKontrolResource
    {
        return new RencanaKontrolResource($rencanaKontrol);
    }

    public function update(UpdateRencanaKontrolRequest $request, RencanaKontrol $rencanaKontrol)
    {
        $rencanaKontrol->fill($request->validated());
        $rencanaKontrol->load('sep');

        $bpjsResponse = $this->vclaim->updateRencanaKontrol($this->buildPayload($rencanaKontrol));
        $this->applyResult($rencanaKontrol, $bpjsResponse);

        return new RencanaKontrolResource($rencanaKontrol->fresh());
    }

    public function destroy(RencanaKontrol $rencanaKontrol)
    {
        $bpjsResponse = $this->vclaim->deleteRencanaKontrol([
            'noSuratKontrol' => $rencanaKontrol->no_surat_kontrol,
            'user' => auth()->user()?->name ?? 'system',
        ]);

        if ($this->bpjsSucceeded($bpjsResponse)) {
            $rencanaKontrol->update([
                'local_status' => 'deleted',
                'bpjs_response' => $this->bpjsResponseArray($bpjsResponse),
                'error_message' => null,
            ]);

            return response()->json(['message' => 'Rencana kontrol deleted'], 200);
        }

        $rencanaKontrol->update([
            'bpjs_response' => $this->bpjsResponseArray($bpjsResponse),
            'error_message' => $this->bpjsMessage($bpjsResponse),
        ]);

        return response()->json(['message' => $this->bpjsMessage($bpjsResponse) ?? 'BPJS rejected the delete'], 422);
    }

    // ---- Passthrough lookups used while building the control-letter form ----

    public function listSpesialistik(Request $request)
    {
        return response()->json($this->vclaim->listSpesialistikKontrol(
            $request->string('jenis_kontrol'),
            $request->string('nomor'),
            $request->string('tanggal_rencana_kontrol'),
        ));
    }

    public function jadwalPraktekDokter(Request $request)
    {
        return response()->json($this->vclaim->jadwalPraktekDokter(
            $request->string('jenis_kontrol'),
            $request->string('poli_kontrol'),
            $request->string('tanggal_rencana_kontrol'),
        ));
    }

    private function applyResult(RencanaKontrol $rencanaKontrol, object $bpjsResponse): void
    {
        if ($this->bpjsSucceeded($bpjsResponse)) {
            $rencanaKontrol->update([
                'no_surat_kontrol' => $bpjsResponse->response->noSuratKontrol ?? $rencanaKontrol->no_surat_kontrol,
                'local_status' => 'success',
                'bpjs_response' => $this->bpjsResponseArray($bpjsResponse),
                'error_message' => null,
            ]);
        } else {
            $rencanaKontrol->update([
                'local_status' => 'error',
                'bpjs_response' => $this->bpjsResponseArray($bpjsResponse),
                'error_message' => $this->bpjsMessage($bpjsResponse),
            ]);
        }
    }

    private function buildPayload(RencanaKontrol $rencanaKontrol): array
    {
        $dpjp = $rencanaKontrol->dpjp_doctor_id ? Doctor::find($rencanaKontrol->dpjp_doctor_id) : null;

        return array_filter([
            'noSep' => $rencanaKontrol->sep?->no_sep,
            'kdJnsKontrol' => $rencanaKontrol->jenis_kontrol,
            'poliKontrol' => $rencanaKontrol->poli_kontrol,
            'tglRencanaKontrol' => $rencanaKontrol->tanggal_rencana_kontrol?->toDateString(),
            'dpjp' => $dpjp?->sip_number,
            'noSuratKontrol' => $rencanaKontrol->no_surat_kontrol,
            'user' => auth()->user()?->name ?? 'system',
        ], fn ($value) => $value !== null);
    }
}
