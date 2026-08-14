<?php

namespace Modules\SirsOnlineBor\Services;

use Illuminate\Support\Arr;
use Modules\SirsOnlineBor\Models\TempatTidur;

class SirsOnlineBorService
{
    public function __construct(private readonly SirsOnlineBorClient $client)
    {
    }

    private const FIELDS = [
        'id_tt', 'ruang', 'jumlah_ruang', 'jumlah', 'terpakai', 'terpakai_suspek',
        'terpakai_konfirmasi', 'antrian', 'prepare', 'prepare_plan', 'covid',
        'terpakai_dbd', 'terpakai_dbd_anak', 'jumlah_dbd',
    ];

    public function create(array $data): TempatTidur
    {
        return $this->push('POST', TempatTidur::create($this->onlyFields($data) + ['status' => 'pending']));
    }

    public function update(TempatTidur $tempatTidur, array $data): TempatTidur
    {
        $tempatTidur->fill($this->onlyFields($data));
        $tempatTidur->save();

        return $this->push('PUT', $tempatTidur);
    }

    public function delete(TempatTidur $tempatTidur): object
    {
        // DELETE targets ?id_t_tt={id} per the live-verified endpoint (note the
        // different field name from the POST/PUT body's id_tt).
        $response = $this->client->call('DELETE', ['id_t_tt' => $tempatTidur->id_tt]);
        $tempatTidur->update(['status' => 'deleted', 'response' => json_decode(json_encode($response), true)]);

        return $response;
    }

    public function list(array $query = []): object
    {
        return $this->client->call('GET', $query);
    }

    private function onlyFields(array $data): array
    {
        return array_intersect_key($data, array_flip(self::FIELDS));
    }

    private function push(string $method, TempatTidur $tempatTidur): TempatTidur
    {
        try {
            $response = $this->client->call($method, Arr::only($tempatTidur->toArray(), self::FIELDS));
            $tempatTidur->update([
                'response' => json_decode(json_encode($response), true),
                'status' => 'sent',
            ]);
        } catch (\Throwable $e) {
            $tempatTidur->update([
                'status' => 'failed',
                'error_message' => $e->getMessage(),
            ]);
        }

        return $tempatTidur->fresh();
    }
}
