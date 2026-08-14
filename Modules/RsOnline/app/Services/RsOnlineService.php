<?php

namespace Modules\RsOnline\Services;

use Modules\RsOnline\Models\RsOnlineSubmission;
use Modules\Sisrute\Services\SisruteClient;

/**
 * RS Online (SumberDaya-v1 + RsOnline-v1) endpoints. Reuses the shared
 * Modules\Sisrute\Services\SisruteClient HMAC client - RS Online lives on the
 * same dvlp-sisrute.kemkes.go.id host with the same auth scheme (verified in
 * kemkes_research_findings_part2.md section 1.4/1.7), so no separate
 * HTTP/signature logic is reimplemented here.
 */
class RsOnlineService
{
    public function __construct(private readonly SisruteClient $client)
    {
    }

    // ---- Push/write resources (SumberDaya-v1), local ledger kept --------

    public function pushSdm(array $data, ?string $id = null): RsOnlineSubmission
    {
        return $this->record('data_sdm', $id ? "rsonline/data/sdm/{$id}" : 'rsonline/data/sdm', $data);
    }

    public function pushLayanan(array $data, ?string $id = null): RsOnlineSubmission
    {
        return $this->record('data_layanan', $id ? "rsonline/data/layanan/{$id}" : 'rsonline/data/layanan', $data);
    }

    public function pushAlkes(array $data, ?string $alkesDataId = null): RsOnlineSubmission
    {
        return $this->record('alkes_data', $alkesDataId ? "rsonline/data/alkes/{$alkesDataId}" : 'rsonline/data/alkes', $data);
    }

    public function pushTempatTidur(array $data, ?string $id = null): RsOnlineSubmission
    {
        return $this->record('data_tempat_tidur', $id ? "rsonline/data/tempattidur/{$id}" : 'rsonline/data/tempattidur', $data);
    }

    // ---- RegistrasiUser (RsOnline-v1, full CRUD) -------------------------

    public function registrasiUser(array $data): RsOnlineSubmission
    {
        return $this->record('registrasi_user', 'rsonline/registrasi-user', $data);
    }

    public function updateRegistrasiUser(string $id, array $data): object
    {
        return $this->client->call('PUT', "rsonline/registrasi-user/{$id}", $data);
    }

    public function deleteRegistrasiUser(string $id): object
    {
        return $this->client->call('DELETE', "rsonline/registrasi-user/{$id}");
    }

    // ---- Referensi (10 read-only lookups from SumberDaya-v1) ------------

    public function referensiSdm(array $query = []): object
    {
        return $this->client->call('GET', 'rsonline/referensi/sdm', $query);
    }

    public function referensiSarana(array $query = []): object
    {
        return $this->client->call('GET', 'rsonline/referensi/sarana', $query);
    }

    public function referensiRuangPerawatan(array $query = []): object
    {
        return $this->client->call('GET', 'rsonline/referensi/ruangperawatan', $query);
    }

    public function referensiPelayanan(array $query = []): object
    {
        return $this->client->call('GET', 'rsonline/referensi/pelayanan', $query);
    }

    public function referensiKelas(array $query = []): object
    {
        return $this->client->call('GET', 'rsonline/referensi/kelas', $query);
    }

    public function referensiKategoriSdm(array $query = []): object
    {
        return $this->client->call('GET', 'rsonline/referensi/kategorisdm', $query);
    }

    public function referensiKategoriLayanan(array $query = []): object
    {
        return $this->client->call('GET', 'rsonline/referensi/kategorilayanan', $query);
    }

    public function referensiInstalasi(array $query = []): object
    {
        return $this->client->call('GET', 'rsonline/referensi/instalasi', $query);
    }

    public function referensiAlkes(array $query = []): object
    {
        return $this->client->call('GET', 'rsonline/referensi/alkes', $query);
    }

    public function faskes(array $query = []): object
    {
        return $this->client->call('GET', 'rsonline/faskes', $query);
    }

    private function record(string $resource, string $uri, array $data): RsOnlineSubmission
    {
        $local = RsOnlineSubmission::create([
            'resource' => $resource,
            'payload' => $data,
            'status' => 'pending',
        ]);

        try {
            $response = $this->client->call('POST', $uri, $data);
            $local->update([
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
