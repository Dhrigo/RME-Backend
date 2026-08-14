<?php

namespace Modules\BpjsVClaim\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\BpjsVClaim\Http\Requests\StoreRujukanKhususRequest;
use Modules\BpjsVClaim\Http\Resources\RujukanKhususResource;
use Modules\BpjsVClaim\Models\RujukanKhusus;
use Modules\BpjsVClaim\Services\VClaimService;
use Modules\BpjsVClaim\Support\RecordsBpjsResult;

class RujukanKhususController extends Controller
{
    use RecordsBpjsResult;

    public function __construct(private readonly VClaimService $vclaim)
    {
    }

    public function index(Request $request)
    {
        return RujukanKhususResource::collection(
            RujukanKhusus::query()->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreRujukanKhususRequest $request)
    {
        $rujukanKhusus = RujukanKhusus::create($request->validated() + ['local_status' => 'draft']);

        $bpjsResponse = $this->vclaim->insertRujukanKhusus([
            'noRujukan' => $rujukanKhusus->no_rujukan_asal,
            'diagnosa' => $rujukanKhusus->diagnosa,
            'procedure' => $rujukanKhusus->kode_prosedur,
            'user' => auth()->user()?->name ?? 'system',
        ]);

        if ($this->bpjsSucceeded($bpjsResponse)) {
            $rujukanKhusus->update([
                'no_rujukan_khusus' => $bpjsResponse->response->noRujukan ?? $rujukanKhusus->no_rujukan_khusus,
                'local_status' => 'success',
                'bpjs_response' => $this->bpjsResponseArray($bpjsResponse),
                'error_message' => null,
            ]);
        } else {
            $rujukanKhusus->update([
                'local_status' => 'error',
                'bpjs_response' => $this->bpjsResponseArray($bpjsResponse),
                'error_message' => $this->bpjsMessage($bpjsResponse),
            ]);
        }

        return (new RujukanKhususResource($rujukanKhusus->fresh()))->response()->setStatusCode(201);
    }

    public function show(RujukanKhusus $rujukanKhusus): RujukanKhususResource
    {
        return new RujukanKhususResource($rujukanKhusus);
    }

    public function destroy(RujukanKhusus $rujukanKhusus)
    {
        $bpjsResponse = $this->vclaim->deleteRujukanKhusus([
            'noRujukan' => $rujukanKhusus->no_rujukan_khusus,
            'user' => auth()->user()?->name ?? 'system',
        ]);

        if ($this->bpjsSucceeded($bpjsResponse)) {
            $rujukanKhusus->update([
                'local_status' => 'deleted',
                'bpjs_response' => $this->bpjsResponseArray($bpjsResponse),
                'error_message' => null,
            ]);

            return response()->json(['message' => 'Rujukan khusus deleted'], 200);
        }

        $rujukanKhusus->update([
            'bpjs_response' => $this->bpjsResponseArray($bpjsResponse),
            'error_message' => $this->bpjsMessage($bpjsResponse),
        ]);

        return response()->json(['message' => $this->bpjsMessage($bpjsResponse) ?? 'BPJS rejected the delete'], 422);
    }
}
