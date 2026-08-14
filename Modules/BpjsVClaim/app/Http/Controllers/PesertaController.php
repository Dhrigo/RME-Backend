<?php

namespace Modules\BpjsVClaim\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\BpjsVClaim\Services\VClaimService;

/**
 * Live BPJS participant lookup - not persisted locally (per task instructions this is
 * live-fetched data, distinct from the transactional SEP/Rujukan/RencanaKontrol tables).
 */
class PesertaController extends Controller
{
    public function __construct(private readonly VClaimService $vclaim)
    {
    }

    public function byNoKartu(string $noKartu, string $tglSep)
    {
        return response()->json($this->vclaim->pesertaByNoKartu($noKartu, $tglSep));
    }

    public function byNik(string $nik, string $tglSep)
    {
        return response()->json($this->vclaim->pesertaByNik($nik, $tglSep));
    }

    public function suplesiJasaRaharja(string $noKartu, string $tglPelayanan)
    {
        return response()->json($this->vclaim->suplesiJasaRaharja($noKartu, $tglPelayanan));
    }
}
