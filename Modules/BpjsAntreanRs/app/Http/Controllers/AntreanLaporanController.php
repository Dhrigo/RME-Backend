<?php

namespace Modules\BpjsAntreanRs\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Bpjs\Services\BpjsClient;

/**
 * Read/reporting endpoints against BPJS's own stored antrean data — thin
 * passthrough GET wrappers, no local persistence (Antrean Per Tanggal,
 * Antrean Per Kode Booking, Antrean Belum Dilayani, Antrean Belum Dilayani
 * Per Poli Per Dokter Per Hari Per Jam Praktek). URI paths inferred from
 * BPJS's Antrean naming convention, not individually confirmed.
 */
class AntreanLaporanController extends Controller
{
    public function __construct(private readonly BpjsClient $client)
    {
    }

    public function perTanggal(string $tanggal, string $kodepoli)
    {
        return $this->client->call('antrean_rs', 'GET', "antrean/tanggal/{$tanggal}/{$kodepoli}");
    }

    public function perKodeBooking(string $kodebooking)
    {
        return $this->client->call('antrean_rs', 'GET', "antrean/kodebooking/{$kodebooking}");
    }

    public function belumDilayani(string $kodepoli)
    {
        return $this->client->call('antrean_rs', 'GET', "antrean/belumdilayani/{$kodepoli}");
    }

    public function belumDilayaniDetail(string $kodepoli, string $kodedokter, string $tanggal, string $jampraktek)
    {
        return $this->client->call(
            'antrean_rs',
            'GET',
            "antrean/belumdilayani/{$kodepoli}/{$kodedokter}/{$tanggal}/{$jampraktek}"
        );
    }
}
