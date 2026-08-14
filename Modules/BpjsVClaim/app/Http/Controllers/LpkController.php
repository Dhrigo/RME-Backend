<?php

namespace Modules\BpjsVClaim\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\BpjsVClaim\Services\VClaimService;

/**
 * LPK (Lembar Pengajuan Klaim) - minimal read-only wrapper per task scope (list/search
 * only). Endpoint path confirmed against the original ZF2 source (LPKService.php).
 */
class LpkController extends Controller
{
    public function __construct(private readonly VClaimService $vclaim)
    {
    }

    public function list(Request $request)
    {
        return response()->json($this->vclaim->lpkList(
            $request->string('tgl_masuk'),
            $request->string('jenis_pelayanan'),
        ));
    }
}
