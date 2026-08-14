<?php

namespace Modules\Sisrute\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Sisrute\Services\SisruteService;

/**
 * Thin passthrough for the 10 SISRUTE Referensi (v1) lookups - live results,
 * never persisted locally (same rationale as BpjsVClaim's ReferensiController).
 */
class ReferensiController extends Controller
{
    public function __construct(private readonly SisruteService $service)
    {
    }

    public function faskes(Request $request)
    {
        return response()->json($this->service->referensiFaskes($request->query()));
    }

    public function alasanRujukan(Request $request)
    {
        return response()->json($this->service->referensiAlasanRujukan($request->query()));
    }

    public function diagnosa(Request $request)
    {
        return response()->json($this->service->referensiDiagnosa($request->query()));
    }

    public function jenisPelayanan(Request $request)
    {
        return response()->json($this->service->referensiJenisPelayanan($request->query()));
    }

    public function keadaanKeluar(Request $request)
    {
        return response()->json($this->service->referensiKeadaanKeluar($request->query()));
    }

    public function caraKeluar(Request $request)
    {
        return response()->json($this->service->referensiCaraKeluar($request->query()));
    }

    public function filterFaskesKriteria(Request $request)
    {
        return response()->json($this->service->referensiFilterFaskesKriteria($request->query()));
    }

    public function kriteriaKhusus(Request $request)
    {
        return response()->json($this->service->referensiKriteriaKhusus($request->query()));
    }

    public function kriteriaRujukan(Request $request)
    {
        return response()->json($this->service->referensiKriteriaRujukan($request->query()));
    }

    public function kriteriaMatneo(Request $request)
    {
        return response()->json($this->service->referensiKriteriaMatneo($request->query()));
    }
}
