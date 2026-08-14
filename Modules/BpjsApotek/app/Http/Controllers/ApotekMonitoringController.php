<?php

namespace Modules\BpjsApotek\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Bpjs\Services\BpjsClient;

/**
 * "Monitoring" menu (Data Klaim) - read-only claim-status monitoring by date
 * range, thin passthrough. Endpoint path (monitoring/dataklaim/{start}/{end})
 * inferred from BPJS's documented Apotek naming convention - flagged for review.
 */
class ApotekMonitoringController extends Controller
{
    public function __construct(private readonly BpjsClient $client)
    {
    }

    public function index(Request $request): object
    {
        $request->validate([
            'tanggal_mulai' => ['required', 'date'],
            'tanggal_akhir' => ['required', 'date'],
        ]);

        return $this->client->call(
            'apotek',
            'GET',
            'monitoring/dataklaim/'.$request->string('tanggal_mulai').'/'.$request->string('tanggal_akhir'),
        );
    }
}
