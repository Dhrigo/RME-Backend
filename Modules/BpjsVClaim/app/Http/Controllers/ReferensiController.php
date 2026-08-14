<?php

namespace Modules\BpjsVClaim\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\BpjsVClaim\Services\VClaimService;

/**
 * Thin passthrough for BPJS's live reference/lookup endpoints (faskes, dokter,
 * diagnosa, poli, propinsi/kabupaten/kecamatan, procedure). Deliberately not persisted
 * locally - these are queried fresh from BPJS per request, per the task's instruction
 * not to default to caching reference data.
 */
class ReferensiController extends Controller
{
    public function __construct(private readonly VClaimService $vclaim)
    {
    }

    public function faskes(Request $request, string $parameter1, string $parameter2)
    {
        return response()->json($this->vclaim->referensiFaskes($parameter1, $parameter2));
    }

    public function dokter(Request $request)
    {
        return response()->json($this->vclaim->referensiDokter(
            $request->string('jenis_pelayanan'),
            $request->string('tgl_pelayanan'),
            $request->string('kode_spesialis'),
        ));
    }

    public function diagnosa(string $query)
    {
        return response()->json($this->vclaim->referensiDiagnosa($query));
    }

    public function poli(string $query)
    {
        return response()->json($this->vclaim->referensiPoli($query));
    }

    public function propinsi()
    {
        return response()->json($this->vclaim->referensiPropinsi());
    }

    public function kabupaten(string $kodePropinsi)
    {
        return response()->json($this->vclaim->referensiKabupaten($kodePropinsi));
    }

    public function kecamatan(string $kodeKabupaten)
    {
        return response()->json($this->vclaim->referensiKecamatan($kodeKabupaten));
    }

    public function procedure(string $query)
    {
        return response()->json($this->vclaim->referensiProcedure($query));
    }
}
