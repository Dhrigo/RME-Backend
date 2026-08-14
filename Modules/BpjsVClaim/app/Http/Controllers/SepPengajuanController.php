<?php

namespace Modules\BpjsVClaim\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\BpjsVClaim\Http\Requests\ApproveSepPengajuanRequest;
use Modules\BpjsVClaim\Http\Requests\StoreSepPengajuanRequest;
use Modules\BpjsVClaim\Http\Resources\SepPengajuanResource;
use Modules\BpjsVClaim\Models\Sep;
use Modules\BpjsVClaim\Models\SepPengajuan;
use Modules\BpjsVClaim\Services\VClaimService;
use Modules\BpjsVClaim\Support\RecordsBpjsResult;

/**
 * SEP backdate/fingerprint exception flow: submit via POST Sep/pengajuanSEP, then
 * approve via POST Sep/aprovalSEP. Only fingerprint approvals happen at hospital level -
 * backdate approvals happen at BPJS's own office, so the approve endpoint here is really
 * "record what BPJS told us", not "grant the approval" for backdate requests.
 */
class SepPengajuanController extends Controller
{
    use RecordsBpjsResult;

    public function __construct(private readonly VClaimService $vclaim)
    {
    }

    public function store(StoreSepPengajuanRequest $request)
    {
        $sep = Sep::findOrFail($request->integer('sep_id'));
        $pengajuan = SepPengajuan::create($request->validated());

        $bpjsResponse = $this->vclaim->pengajuanSep([
            'noKartu' => $sep->no_kartu,
            'tglSep' => $sep->tgl_sep?->toDateString(),
            'jenis' => $pengajuan->jenis,
            'keterangan' => $pengajuan->alasan,
            'user' => auth()->user()?->name ?? 'system',
        ]);

        $pengajuan->update([
            'status' => $this->bpjsSucceeded($bpjsResponse) ? 'submitted' : 'rejected',
            'bpjs_response' => $this->bpjsResponseArray($bpjsResponse),
            'error_message' => $this->bpjsSucceeded($bpjsResponse) ? null : $this->bpjsMessage($bpjsResponse),
        ]);

        return (new SepPengajuanResource($pengajuan->fresh()))->response()->setStatusCode(201);
    }

    public function approve(ApproveSepPengajuanRequest $request, SepPengajuan $sepPengajuan)
    {
        $bpjsResponse = $this->vclaim->aprovalSep([
            'noPengajuan' => $sepPengajuan->id,
            'approved' => $request->boolean('approved'),
            'user' => auth()->user()?->name ?? 'system',
        ]);

        $sepPengajuan->update([
            'status' => $this->bpjsSucceeded($bpjsResponse)
                ? ($request->boolean('approved') ? 'approved' : 'rejected')
                : 'rejected',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
            'bpjs_response' => $this->bpjsResponseArray($bpjsResponse),
            'error_message' => $this->bpjsSucceeded($bpjsResponse) ? null : $this->bpjsMessage($bpjsResponse),
        ]);

        return new SepPengajuanResource($sepPengajuan->fresh());
    }
}
