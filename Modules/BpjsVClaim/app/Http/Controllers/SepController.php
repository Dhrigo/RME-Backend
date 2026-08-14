<?php

namespace Modules\BpjsVClaim\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\BpjsVClaim\Http\Requests\StoreSepRequest;
use Modules\BpjsVClaim\Http\Requests\UpdateSepRequest;
use Modules\BpjsVClaim\Http\Resources\SepResource;
use Modules\BpjsVClaim\Models\Sep;
use Modules\BpjsVClaim\Services\VClaimService;
use Modules\BpjsVClaim\Support\RecordsBpjsResult;

/**
 * SEP (Surat Eligibilitas Peserta). One controller/endpoint handles all 4 creation
 * flows (IGD / Rujukan Kunjungan Pertama / Rujukan Kunjungan Kedua+ / Rawat Inap) -
 * StoreSepRequest enforces the field set each flow actually requires, this controller
 * just builds the BPJS payload from whatever was validated and records the outcome.
 */
class SepController extends Controller
{
    use RecordsBpjsResult;

    public function __construct(private readonly VClaimService $vclaim)
    {
    }

    public function index(Request $request)
    {
        $query = Sep::query();

        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->integer('patient_id'));
        }
        if ($request->filled('visit_type')) {
            $query->where('visit_type', $request->string('visit_type'));
        }
        if ($request->filled('local_status')) {
            $query->where('local_status', $request->string('local_status'));
        }

        return SepResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreSepRequest $request)
    {
        $sep = Sep::create($request->validated() + ['local_status' => 'draft']);

        $bpjsResponse = $this->vclaim->insertSep($this->buildSepPayload($sep));

        if ($this->bpjsSucceeded($bpjsResponse)) {
            $sep->update([
                'no_sep' => $bpjsResponse->response->sep->noSep ?? null,
                'local_status' => 'success',
                'bpjs_response' => $this->bpjsResponseArray($bpjsResponse),
                'error_message' => null,
                'submitted_at' => now(),
            ]);
        } else {
            $sep->update([
                'local_status' => 'error',
                'bpjs_response' => $this->bpjsResponseArray($bpjsResponse),
                'error_message' => $this->bpjsMessage($bpjsResponse),
                'submitted_at' => now(),
            ]);
        }

        return (new SepResource($sep->fresh()))->response()->setStatusCode(201);
    }

    public function show(Sep $sep): SepResource
    {
        return new SepResource($sep);
    }

    public function update(UpdateSepRequest $request, Sep $sep)
    {
        $sep->fill($request->validated());

        $bpjsResponse = $this->vclaim->updateSep($this->buildSepPayload($sep));

        if ($this->bpjsSucceeded($bpjsResponse)) {
            $sep->local_status = 'success';
            $sep->error_message = null;
        } else {
            $sep->local_status = 'error';
            $sep->error_message = $this->bpjsMessage($bpjsResponse);
        }
        $sep->bpjs_response = $this->bpjsResponseArray($bpjsResponse);
        $sep->save();

        return new SepResource($sep);
    }

    /**
     * BPJS only allows deleting a SEP before verification/billing - we still record the
     * attempt result locally either way so staff see why a delete didn't go through.
     */
    public function destroy(Sep $sep)
    {
        $bpjsResponse = $this->vclaim->deleteSep([
            'noSep' => $sep->no_sep,
            'user' => auth()->user()?->name ?? 'system',
        ]);

        if ($this->bpjsSucceeded($bpjsResponse)) {
            $sep->update([
                'local_status' => 'deleted',
                'bpjs_response' => $this->bpjsResponseArray($bpjsResponse),
                'error_message' => null,
            ]);

            return response()->json(['message' => 'SEP deleted'], 200);
        }

        $sep->update([
            'bpjs_response' => $this->bpjsResponseArray($bpjsResponse),
            'error_message' => $this->bpjsMessage($bpjsResponse),
        ]);

        return response()->json(['message' => $this->bpjsMessage($bpjsResponse) ?? 'BPJS rejected the delete'], 422);
    }

    private function buildSepPayload(Sep $sep): array
    {
        return array_filter([
            'noKartu' => $sep->no_kartu,
            'tglSep' => $sep->tgl_sep?->toDateString(),
            'jnsPelayanan' => $sep->visit_type === 'rawat_inap' ? '1' : '2',
            'klsRawat' => $sep->kelas_rawat,
            'noRujukan' => $sep->no_rujukan,
            'poliTujuan' => $sep->poli_tujuan,
            'dpjp' => $sep->dpjpDoctor?->sip_number,
            'diagAwal' => $sep->diagnosa_awal,
            'catatan' => $sep->catatan,
            'noSuratKontrol' => $sep->no_surat_kontrol,
            'skdp' => [
                'noKunjungan' => $sep->no_rujukan,
                'noSurat' => $sep->no_surat_kontrol,
            ],
            'kdKecelakaanLantas' => $sep->status_kecelakaan,
            'lokasiLaka' => array_filter([
                'kdPropinsi' => $sep->kecelakaan_provinsi_code,
                'kdKabupaten' => $sep->kecelakaan_kabupaten_code,
                'kdKecamatan' => $sep->kecelakaan_kecamatan_code,
            ]) ?: null,
            'noSep' => $sep->no_sep,
            'user' => auth()->user()?->name ?? 'system',
        ], fn ($value) => $value !== null && $value !== []);
    }
}
