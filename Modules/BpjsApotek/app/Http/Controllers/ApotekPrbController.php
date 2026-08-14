<?php

namespace Modules\BpjsApotek\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Bpjs\Services\BpjsClient;

/**
 * "PRB" menu (Rekap Peserta PRB) - read-only recap/report of PRB program
 * participants, thin passthrough. Endpoint path (prb/rekappeserta/{month}/{year})
 * inferred from BPJS's documented Apotek naming convention - flagged for review.
 */
class ApotekPrbController extends Controller
{
    public function __construct(private readonly BpjsClient $client)
    {
    }

    public function index(Request $request): object
    {
        $request->validate([
            'bulan' => ['required', 'integer', 'between:1,12'],
            'tahun' => ['required', 'integer', 'digits:4'],
        ]);

        return $this->client->call('apotek', 'GET', 'prb/rekappeserta/'.$request->integer('bulan').'/'.$request->integer('tahun'));
    }
}
