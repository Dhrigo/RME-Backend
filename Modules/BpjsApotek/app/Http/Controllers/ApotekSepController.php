<?php

namespace Modules\BpjsApotek\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Bpjs\Services\BpjsClient;

/**
 * "SEP" menu (Cari No Kunjungan/SEP) - thin lookup used while building Resep/
 * Pelayanan Obat records, no local table. Endpoint path (sep/{query}) inferred
 * from BPJS's documented Apotek naming convention - flagged for review.
 */
class ApotekSepController extends Controller
{
    public function __construct(private readonly BpjsClient $client)
    {
    }

    public function show(Request $request, string $query): object
    {
        return $this->client->call('apotek', 'GET', 'sep/'.$query);
    }
}
