<?php

namespace Modules\BpjsAntreanFktp\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Bpjs\Services\BpjsClient;

/**
 * "Dashboard Per Tanggal" / "Dashboard Per Bulan" — read-only reports
 * against BPJS's own stored antrean data, no local persistence. URI paths
 * inferred from BPJS's Antrean naming convention, not individually confirmed.
 */
class AntreanDashboardController extends Controller
{
    public function __construct(private readonly BpjsClient $client)
    {
    }

    public function perTanggal(string $tanggal, string $kodepoli)
    {
        return $this->client->call('antrean_fktp', 'GET', "dashboard/tanggal/{$tanggal}/{$kodepoli}");
    }

    public function perBulan(string $bulan, string $tahun, string $kodepoli)
    {
        return $this->client->call('antrean_fktp', 'GET', "dashboard/bulan/{$bulan}/{$tahun}/{$kodepoli}");
    }
}
