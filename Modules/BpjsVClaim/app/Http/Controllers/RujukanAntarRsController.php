<?php

namespace Modules\BpjsVClaim\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\BpjsVClaim\Http\Requests\StoreRujukanAntarRsRequest;
use Modules\BpjsVClaim\Http\Requests\UpdateRujukanAntarRsRequest;
use Modules\BpjsVClaim\Http\Resources\RujukanAntarRsResource;
use Modules\BpjsVClaim\Models\RujukanAntarRs;
use Modules\BpjsVClaim\Services\VClaimService;
use Modules\BpjsVClaim\Support\RecordsBpjsResult;

class RujukanAntarRsController extends Controller
{
    use RecordsBpjsResult;

    public function __construct(private readonly VClaimService $vclaim)
    {
    }

    public function index(Request $request)
    {
        $query = RujukanAntarRs::query();
        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->integer('patient_id'));
        }

        return RujukanAntarRsResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreRujukanAntarRsRequest $request)
    {
        $rujukan = RujukanAntarRs::create($request->validated() + ['local_status' => 'draft']);

        $bpjsResponse = $this->vclaim->insertRujukan($this->buildPayload($rujukan));
        $this->applyResult($rujukan, $bpjsResponse);

        return (new RujukanAntarRsResource($rujukan->fresh()))->response()->setStatusCode(201);
    }

    public function show(RujukanAntarRs $rujukanAntarRs): RujukanAntarRsResource
    {
        return new RujukanAntarRsResource($rujukanAntarRs);
    }

    public function update(UpdateRujukanAntarRsRequest $request, RujukanAntarRs $rujukanAntarRs)
    {
        $rujukanAntarRs->fill($request->validated());

        $bpjsResponse = $this->vclaim->updateRujukan($this->buildPayload($rujukanAntarRs));
        $this->applyResult($rujukanAntarRs, $bpjsResponse);

        return new RujukanAntarRsResource($rujukanAntarRs->fresh());
    }

    /**
     * BPJS only allows deleting before the referring hospital issues its own SEP against
     * this referral - we still record the attempt result locally either way.
     */
    public function destroy(RujukanAntarRs $rujukanAntarRs)
    {
        $bpjsResponse = $this->vclaim->deleteRujukan([
            'noRujukan' => $rujukanAntarRs->no_rujukan,
            'user' => auth()->user()?->name ?? 'system',
        ]);

        if ($this->bpjsSucceeded($bpjsResponse)) {
            $rujukanAntarRs->update([
                'local_status' => 'deleted',
                'bpjs_response' => $this->bpjsResponseArray($bpjsResponse),
                'error_message' => null,
            ]);

            return response()->json(['message' => 'Rujukan deleted'], 200);
        }

        $rujukanAntarRs->update([
            'bpjs_response' => $this->bpjsResponseArray($bpjsResponse),
            'error_message' => $this->bpjsMessage($bpjsResponse),
        ]);

        return response()->json(['message' => $this->bpjsMessage($bpjsResponse) ?? 'BPJS rejected the delete'], 422);
    }

    private function applyResult(RujukanAntarRs $rujukan, object $bpjsResponse): void
    {
        if ($this->bpjsSucceeded($bpjsResponse)) {
            $rujukan->update([
                'no_rujukan' => $bpjsResponse->response->rujukan->noRujukan ?? $rujukan->no_rujukan,
                'local_status' => 'success',
                'bpjs_response' => $this->bpjsResponseArray($bpjsResponse),
                'error_message' => null,
            ]);
        } else {
            $rujukan->update([
                'local_status' => 'error',
                'bpjs_response' => $this->bpjsResponseArray($bpjsResponse),
                'error_message' => $this->bpjsMessage($bpjsResponse),
            ]);
        }
    }

    private function buildPayload(RujukanAntarRs $rujukan): array
    {
        return array_filter([
            'noSep' => $rujukan->no_sep_asal,
            'tglRujukan' => $rujukan->tanggal_rencana_kunjungan?->toDateString(),
            'jnsPelayanan' => $rujukan->jenis_pelayanan,
            'tipeRujukan' => $rujukan->tipe_rujukan,
            'ppkTujuan' => $rujukan->ppk_tujuan,
            'diagnosa' => $rujukan->diagnosa,
            'catatan' => $rujukan->catatan,
            'noRujukan' => $rujukan->no_rujukan,
            'user' => auth()->user()?->name ?? 'system',
        ], fn ($value) => $value !== null);
    }
}
