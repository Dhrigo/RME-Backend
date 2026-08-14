<?php

namespace Modules\Sisrute\Services;

use Modules\Sisrute\Models\Rujukan;

/**
 * Rujukan (referral) + Referensi (lookup) endpoints for SISRUTE core.
 * URI paths follow the {module-lowercase}/{resource-lowercase} convention
 * confirmed live for Informasi-v1/SumberDaya-v1/ResumeMedis-v1 (e.g.
 * /informasi/keaktifansisrute, /rsonline/referensi/sdm) - the Rujukan-v1 and
 * Referensi-v1 panels only listed resource names without full paths, so the
 * same verified convention is applied here rather than inventing a
 * different shape.
 */
class SisruteService
{
    public function __construct(private readonly SisruteClient $client)
    {
    }

    // ---- Rujukan (6 resources) -----------------------------------------

    public function kirimRujukan(array $data): Rujukan
    {
        return $this->record('outbound', 'rujukan', 'rujukan/rujukan', 'POST', $data);
    }

    public function notifRujukan(array $data): Rujukan
    {
        return $this->record('inbound', 'notifrujukan', 'rujukan/notifrujukan', 'POST', $data);
    }

    public function jawabRujukan(array $data): Rujukan
    {
        return $this->record('outbound', 'jawabrujukan', 'rujukan/jawabrujukan', 'POST', $data);
    }

    public function batalRujukan(array $data): Rujukan
    {
        return $this->record('outbound', 'batalrujukan', 'rujukan/batalrujukan', 'POST', $data);
    }

    public function imagesRujukan(array $data): Rujukan
    {
        return $this->record('outbound', 'imagesrujukan', 'rujukan/imagesrujukan', 'POST', $data);
    }

    public function pasienRujukan(string $noRujukan): object
    {
        return $this->client->call('GET', "rujukan/pasienrujukan/{$noRujukan}");
    }

    // ---- Referensi (10 read-only lookups, never persisted) --------------

    public function referensiFaskes(array $query = []): object
    {
        return $this->client->call('GET', 'referensi/faskes', $query);
    }

    public function referensiAlasanRujukan(array $query = []): object
    {
        return $this->client->call('GET', 'referensi/alasanrujukan', $query);
    }

    public function referensiDiagnosa(array $query = []): object
    {
        return $this->client->call('GET', 'referensi/diagnosa', $query);
    }

    public function referensiJenisPelayanan(array $query = []): object
    {
        return $this->client->call('GET', 'referensi/jenispelayanan', $query);
    }

    public function referensiKeadaanKeluar(array $query = []): object
    {
        return $this->client->call('GET', 'referensi/keadaankeluar', $query);
    }

    public function referensiCaraKeluar(array $query = []): object
    {
        return $this->client->call('GET', 'referensi/carakeluar', $query);
    }

    public function referensiFilterFaskesKriteria(array $query = []): object
    {
        return $this->client->call('GET', 'referensi/filterfaskeskriteria', $query);
    }

    public function referensiKriteriaKhusus(array $query = []): object
    {
        return $this->client->call('GET', 'referensi/kriteriakhusus', $query);
    }

    public function referensiKriteriaRujukan(array $query = []): object
    {
        return $this->client->call('GET', 'referensi/kriteriarujukan', $query);
    }

    public function referensiKriteriaMatneo(array $query = []): object
    {
        return $this->client->call('GET', 'referensi/kriteriamatneo', $query);
    }

    private function record(string $direction, string $action, string $uri, string $method, array $data): Rujukan
    {
        $local = Rujukan::create([
            'direction' => $direction,
            'action' => $action,
            'payload' => $data,
            'status' => 'pending',
        ]);

        try {
            $response = $this->client->call($method, $uri, $data);
            $local->update([
                'no_rujukan' => $response->no_rujukan ?? $local->no_rujukan,
                'response' => json_decode(json_encode($response), true),
                'status' => 'sent',
            ]);
        } catch (\Throwable $e) {
            $local->update([
                'status' => 'failed',
                'error_message' => $e->getMessage(),
            ]);
        }

        return $local->fresh();
    }
}
