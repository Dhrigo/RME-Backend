<?php

namespace Modules\BpjsVClaim\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\BpjsVClaim\Services\VClaimService;

/**
 * PRB (Program Rujuk Balik) - minimal read-only wrapper per task scope (list/search
 * only, no local persistence, no complex flow). Endpoint paths confirmed against the
 * original ZF2 source (BPJService\VClaim\v_2_0\PRBService.php).
 */
class PrbController extends Controller
{
    public function __construct(private readonly VClaimService $vclaim)
    {
    }

    public function byNomor(Request $request, string $nomor, string $noSep)
    {
        return response()->json($this->vclaim->prbByNomor($nomor, $noSep));
    }

    public function byTanggal(Request $request)
    {
        return response()->json($this->vclaim->prbByTanggal(
            $request->string('tgl_mulai'),
            $request->string('tgl_akhir'),
        ));
    }
}
