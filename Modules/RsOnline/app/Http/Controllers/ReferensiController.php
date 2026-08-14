<?php

namespace Modules\RsOnline\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\RsOnline\Services\RsOnlineService;

/**
 * Thin passthrough for RS Online's read-only Referensi lookups - live
 * results, never persisted locally.
 */
class ReferensiController extends Controller
{
    public function __construct(private readonly RsOnlineService $service)
    {
    }

    public function sdm(Request $request)
    {
        return response()->json($this->service->referensiSdm($request->query()));
    }

    public function sarana(Request $request)
    {
        return response()->json($this->service->referensiSarana($request->query()));
    }

    public function ruangPerawatan(Request $request)
    {
        return response()->json($this->service->referensiRuangPerawatan($request->query()));
    }

    public function pelayanan(Request $request)
    {
        return response()->json($this->service->referensiPelayanan($request->query()));
    }

    public function kelas(Request $request)
    {
        return response()->json($this->service->referensiKelas($request->query()));
    }

    public function kategoriSdm(Request $request)
    {
        return response()->json($this->service->referensiKategoriSdm($request->query()));
    }

    public function kategoriLayanan(Request $request)
    {
        return response()->json($this->service->referensiKategoriLayanan($request->query()));
    }

    public function instalasi(Request $request)
    {
        return response()->json($this->service->referensiInstalasi($request->query()));
    }

    public function alkes(Request $request)
    {
        return response()->json($this->service->referensiAlkes($request->query()));
    }

    public function faskes(Request $request)
    {
        return response()->json($this->service->faskes($request->query()));
    }
}
