<?php

namespace Modules\BpjsAntreanRs\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Bpjs\Services\BpjsClient;

/**
 * Reference/lookup endpoints — read-only against BPJS's own catalog data,
 * no local persistence. URI paths are inferred from BPJS's Antrean naming
 * convention (referensi/*), NOT individually confirmed — flagged for review.
 */
class AntreanReferensiController extends Controller
{
    public function __construct(private readonly BpjsClient $client)
    {
    }

    public function poli()
    {
        return $this->client->call('antrean_rs', 'GET', 'referensi/poli');
    }

    public function dokter(string $kodepoli, string $tanggal)
    {
        return $this->client->call('antrean_rs', 'GET', "referensi/dokter/{$kodepoli}/{$tanggal}");
    }

    public function jadwalDokter(string $kodedokter, string $tanggal)
    {
        return $this->client->call('antrean_rs', 'GET', "referensi/jadwaldokter/{$kodedokter}/{$tanggal}");
    }

    public function poliFingerPrint()
    {
        return $this->client->call('antrean_rs', 'GET', 'referensi/poli/fingerprint');
    }

    public function pasienFingerPrint(string $norm)
    {
        return $this->client->call('antrean_rs', 'GET', "referensi/pasien/fingerprint/{$norm}");
    }
}
