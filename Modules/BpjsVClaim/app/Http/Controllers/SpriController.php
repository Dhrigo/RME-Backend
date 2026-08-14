<?php

namespace Modules\BpjsVClaim\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\BpjsVClaim\Http\Requests\StoreSpriRequest;
use Modules\BpjsVClaim\Http\Requests\UpdateSpriRequest;
use Modules\BpjsVClaim\Http\Resources\SpriResource;
use Modules\BpjsVClaim\Models\Spri;
use Modules\BpjsVClaim\Services\VClaimService;
use Modules\BpjsVClaim\Support\RecordsBpjsResult;
use Modules\GeneralDoctor\Models\Doctor;

class SpriController extends Controller
{
    use RecordsBpjsResult;

    public function __construct(private readonly VClaimService $vclaim)
    {
    }

    public function index(Request $request)
    {
        $query = Spri::query();
        if ($request->filled('sep_id')) {
            $query->where('sep_id', $request->integer('sep_id'));
        }

        return SpriResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreSpriRequest $request)
    {
        $spri = Spri::create($request->validated() + ['local_status' => 'draft']);
        $spri->load('sep');

        $bpjsResponse = $this->vclaim->insertSpri($this->buildPayload($spri));
        $this->applyResult($spri, $bpjsResponse);

        return (new SpriResource($spri->fresh()))->response()->setStatusCode(201);
    }

    public function show(Spri $spri): SpriResource
    {
        return new SpriResource($spri);
    }

    public function update(UpdateSpriRequest $request, Spri $spri)
    {
        $spri->fill($request->validated());
        $spri->load('sep');

        $bpjsResponse = $this->vclaim->updateSpri($this->buildPayload($spri));
        $this->applyResult($spri, $bpjsResponse);

        return new SpriResource($spri->fresh());
    }

    private function applyResult(Spri $spri, object $bpjsResponse): void
    {
        if ($this->bpjsSucceeded($bpjsResponse)) {
            $spri->update([
                'no_spri' => $bpjsResponse->response->noSPRI ?? $spri->no_spri,
                'local_status' => 'success',
                'bpjs_response' => $this->bpjsResponseArray($bpjsResponse),
                'error_message' => null,
            ]);
        } else {
            $spri->update([
                'local_status' => 'error',
                'bpjs_response' => $this->bpjsResponseArray($bpjsResponse),
                'error_message' => $this->bpjsMessage($bpjsResponse),
            ]);
        }
    }

    private function buildPayload(Spri $spri): array
    {
        $dpjp = $spri->dpjp_doctor_id ? Doctor::find($spri->dpjp_doctor_id) : null;

        return array_filter([
            'noSep' => $spri->sep?->no_sep,
            'tglRencanaRawatInap' => $spri->tanggal_rencana_rawat_inap?->toDateString(),
            'dpjp' => $dpjp?->sip_number,
            'noSPRI' => $spri->no_spri,
            'user' => auth()->user()?->name ?? 'system',
        ], fn ($value) => $value !== null);
    }
}
