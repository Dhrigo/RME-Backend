<?php

namespace Modules\BpjsAntreanRs\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Bpjs\Services\BpjsClient;

/**
 * "Jadwal Operasi RS" / "Jadwal Operasi Pasien" — best-effort guess: thin
 * passthrough to BPJS's own surgery-schedule reference data (this hospital
 * is not the source of truth). URI paths not confirmed — flagged for review.
 */
class MobileJknJadwalOperasiController extends Controller
{
    public function __construct(private readonly BpjsClient $client)
    {
    }

    public function index()
    {
        return $this->client->call('antrean_rs', 'GET', 'jadwaloperasi/rs');
    }

    public function show(string $norm)
    {
        return $this->client->call('antrean_rs', 'GET', "jadwaloperasi/pasien/{$norm}");
    }
}
