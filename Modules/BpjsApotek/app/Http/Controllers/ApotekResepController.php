<?php

namespace Modules\BpjsApotek\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Bpjs\Services\BpjsClient;
use Modules\BpjsApotek\Http\Requests\StoreApotekResepRequest;
use Modules\BpjsApotek\Http\Resources\ApotekResepResource;
use Modules\BpjsApotek\Models\ApotekResep;

/**
 * PRB "Resep" (Simpan/Hapus/Daftar) - the prescription record actually submitted
 * to BPJS for reimbursement. Endpoint paths (resep/insert, resep/delete) are
 * inferred from BPJS's documented Apotek naming convention - flagged for review.
 */
class ApotekResepController extends Controller
{
    public function __construct(private readonly BpjsClient $client)
    {
    }

    public function index(Request $request)
    {
        $query = ApotekResep::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return ApotekResepResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreApotekResepRequest $request)
    {
        $data = $request->validated();
        $data['tanggal_input'] = now()->toDateString();
        $data['status'] = 'draft';
        $data['created_by'] = $request->user()?->id;

        $resep = ApotekResep::create($data);

        $payload = [
            'noSep' => $resep->no_sep,
            'noKartu' => $resep->no_kartu,
            'tglResep' => $resep->tanggal_resep->toDateString(),
            'tglInput' => $resep->tanggal_input,
            'poli' => $resep->poli_kode,
        ];

        $response = $this->client->call('apotek', 'POST', 'resep/insert', $payload);
        $success = ($response->metaData->code ?? null) === '200';

        $resep->update([
            'request_payload' => $payload,
            'bpjs_no_resep' => $success ? ($response->response->noResep ?? null) : null,
            'status' => $success ? 'success' : 'failed',
            'bpjs_message' => $response->metaData->message ?? null,
            'submitted_at' => now(),
        ]);

        return (new ApotekResepResource($resep->fresh()))->response()->setStatusCode(201);
    }

    public function show(ApotekResep $apotek_resep): ApotekResepResource
    {
        return new ApotekResepResource($apotek_resep);
    }

    public function destroy(ApotekResep $apotek_resep)
    {
        $response = $this->client->call('apotek', 'DELETE', 'resep/delete/'.$apotek_resep->bpjs_no_resep);
        $success = ($response->metaData->code ?? null) === '200';

        if (! $success) {
            return response()->json(['message' => $response->metaData->message ?? 'Gagal menghapus resep di BPJS.'], 422);
        }

        $apotek_resep->delete();

        return response()->json(null, 204);
    }
}
