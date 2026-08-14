<?php

namespace Modules\BpjsRekamMedis\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\BpjsRekamMedis\Data\MedicalRecordBundleData;
use Modules\BpjsRekamMedis\Http\Requests\StoreKlaimRequest;
use Modules\BpjsRekamMedis\Http\Resources\KlaimResource;
use Modules\BpjsRekamMedis\Models\Klaim;
use Modules\BpjsRekamMedis\Services\MedicalRecordBundleBuilder;
use Modules\BpjsRekamMedis\Services\RekamMedisService;

/**
 * "Submit medical record bundle for this SEP" - ports BPJS\SmartClaim\V1\Rpc\Klaim\
 * KlaimController::kirimAction() from the original ZF2 source: look up (or create) the local
 * `klaim` tracking record for (no_sep, jenis_pelayanan_id), build the FHIR Bundle, encrypt it,
 * POST rekammedis/insert, then record the outcome.
 */
class KlaimController extends Controller
{
    public function __construct(
        private readonly MedicalRecordBundleBuilder $bundleBuilder,
        private readonly RekamMedisService $rekamMedis,
    ) {
    }

    public function store(StoreKlaimRequest $request)
    {
        $validated = $request->validated();

        $klaim = Klaim::query()->firstOrCreate(
            [
                'no_sep' => $validated['no_sep'],
                'jenis_pelayanan_id' => $validated['jenis_pelayanan_id'],
            ],
            [
                'bulan' => $validated['bulan'],
                'tahun' => $validated['tahun'],
                'dibuat_oleh' => auth()->user()?->name ?? 'system',
                'dibuat_tanggal' => now(),
                'status' => 'draft',
            ],
        );

        $bundleData = new MedicalRecordBundleData(
            noSep: $validated['no_sep'],
            compositionTitle: $validated['composition']['title'],
            compositionDate: $validated['composition']['date'],
            patient: $validated['patient'],
            encounter: $validated['encounter'],
            practitioner: $validated['practitioner'],
            organization: $validated['organization'],
            conditions: $validated['conditions'] ?? [],
            diagnosticReports: $validated['diagnostic_reports'] ?? [],
            procedures: $validated['procedures'] ?? [],
            medicationRequests: $validated['medication_requests'] ?? [],
            devices: $validated['devices'] ?? [],
        );

        $bundle = $this->bundleBuilder->build($bundleData);

        $bpjsResponse = $this->rekamMedis->submit(
            $bundle,
            $validated['no_sep'],
            $validated['jenis_pelayanan_id'],
            $validated['bulan'],
            $validated['tahun'],
        );

        $meta = $bpjsResponse->metadata ?? $bpjsResponse->metaData ?? null;
        $succeeded = $meta !== null && (string) $meta->code === '200';

        $klaim->update([
            'dikirim_oleh' => auth()->user()?->name ?? 'system',
            'dikirim_tanggal' => now(),
            'status' => $succeeded ? 'sent' : 'error',
            'bpjs_response' => json_decode(json_encode($bpjsResponse), true),
            'error_message' => $succeeded ? null : ($meta->message ?? null),
        ]);

        return (new KlaimResource($klaim->fresh()))->response()->setStatusCode($succeeded ? 201 : 422);
    }

    public function show(Klaim $klaim): KlaimResource
    {
        return new KlaimResource($klaim);
    }
}
