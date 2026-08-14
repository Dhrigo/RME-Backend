<?php

namespace Modules\BpjsApotek\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Bpjs\Services\BpjsClient;

/**
 * Thin passthrough to BPJS Apotek's "Referensi" menu - DPHO, Poli, Faskes,
 * Setting Apotek, Spesialistik, Obat. Nothing here is persisted locally; every
 * call queries BPJS live, mirroring VClaim's referensi/{resource}/{query} pattern.
 *
 * Endpoint paths below are inferred from BPJS's documented referensi naming
 * convention (not confirmed against a live Trust Mark sandbox) - flagged for review.
 */
class ApotekReferensiController extends Controller
{
    public function __construct(private readonly BpjsClient $client)
    {
    }

    public function dpho(Request $request, string $query = ''): object
    {
        return $this->client->call('apotek', 'GET', 'referensi/dpho/'.$query);
    }

    public function poli(Request $request, string $query = ''): object
    {
        return $this->client->call('apotek', 'GET', 'referensi/poli/'.$query);
    }

    public function faskes(Request $request, string $query = ''): object
    {
        return $this->client->call('apotek', 'GET', 'referensi/faskes/'.$query);
    }

    public function settingApotek(Request $request): object
    {
        return $this->client->call('apotek', 'GET', 'referensi/settingapotek');
    }

    public function spesialistik(Request $request, string $query = ''): object
    {
        return $this->client->call('apotek', 'GET', 'referensi/spesialistik/'.$query);
    }

    public function obat(Request $request, string $query = ''): object
    {
        return $this->client->call('apotek', 'GET', 'referensi/obat/'.$query);
    }
}
