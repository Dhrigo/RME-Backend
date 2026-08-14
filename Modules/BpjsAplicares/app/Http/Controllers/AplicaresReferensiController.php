<?php

namespace Modules\BpjsAplicares\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Bpjs\Services\BpjsClient;

/**
 * "Referensi Kamar" - room/class type reference lookup, queried live, no local
 * cache (kept thin like BpjsApotek's referensi menu). Endpoint path
 * (referensi/kamar/{query}) inferred from BPJS's documented Aplicares naming
 * convention - flagged for review.
 */
class AplicaresReferensiController extends Controller
{
    public function __construct(private readonly BpjsClient $client)
    {
    }

    public function kamar(Request $request, string $query = ''): object
    {
        return $this->client->call('aplicares', 'GET', 'referensi/kamar/'.$query);
    }
}
