<?php

namespace Modules\BpjsAntreanFktp\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Bpjs\Services\BpjsClient;

/**
 * "Update Jadwal Dokter" — URI/field shape inferred from BPJS's Antrean
 * naming convention, not individually confirmed. Thin passthrough, BPJS
 * is the system of record for doctor schedules.
 */
class AntreanJadwalDokterController extends Controller
{
    public function __construct(private readonly BpjsClient $client)
    {
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'kodedokter' => ['required', 'integer'],
            'kodepoli' => ['required', 'string'],
            'tanggal' => ['required', 'date'],
            'jampraktek' => ['required', 'string'],
            'kuotajkn' => ['nullable', 'integer'],
            'kuotanonjkn' => ['nullable', 'integer'],
        ]);

        return $this->client->call('antrean_fktp', 'POST', 'jadwal/update', $data);
    }
}
