<?php

namespace Modules\BpjsVClaim\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\BpjsVClaim\Services\VClaimService;

/**
 * Klaim monitoring by date range/jenis pelayanan - minimal read-only wrapper per task
 * scope. Endpoint path confirmed against the original ZF2 source (MonitoringService.php).
 */
class MonitoringController extends Controller
{
    public function __construct(private readonly VClaimService $vclaim)
    {
    }

    public function kunjungan(Request $request)
    {
        return response()->json($this->vclaim->monitoringKunjungan(
            $request->string('tanggal'),
            $request->string('jenis_pelayanan'),
        ));
    }
}
