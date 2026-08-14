<?php

namespace Modules\SatuSehatKptl\Services;

use Illuminate\Support\Facades\Http;
use Modules\SatuSehat\Services\SatuSehatClient;

/**
 * RPC-style client for the "Master Data API - KPTL" collection (Klasifikasi
 * Prosedur Tindakan Medis) - see kemkes_research_findings_part2.md section
 * 2.3. Unlike MasterData, every endpoint is POST with a {"method": ...,
 * "query_string": ...} RPC body, not a REST path+query GET. Also sends
 * X-Encryption-Disabled: true per the documented common headers.
 */
class KptlClient
{
    public function __construct(private readonly SatuSehatClient $client)
    {
    }

    protected function baseUrl(): string
    {
        return rtrim((string) config('satusehatkptl.base_url'), '/');
    }

    protected function call(string $path, array $body): object
    {
        return Http::withToken($this->client->token())
            ->withHeaders(['X-Encryption-Disabled' => 'true'])
            ->acceptJson()
            ->post($this->baseUrl().$path, $body)
            ->throw()
            ->object();
    }

    public function code(string $queryString, int $offset = 0, int $limit = 5): object
    {
        return $this->call('/code', [
            'method' => 'get_all_code',
            'query_string' => $queryString,
            'offset' => $offset,
            'limit' => $limit,
        ]);
    }

    public function baseCode(string $queryString, int $offset = 0, int $limit = 5): object
    {
        return $this->call('/base_code', [
            'method' => 'get_all_base_code',
            'query_string' => $queryString,
            'offset' => $offset,
            'limit' => $limit,
        ]);
    }

    public function baseCodeCombination(string $queryString, int $maxIteration = 2): object
    {
        return $this->call('/base_code_combination', [
            'method' => 'get_modifiers',
            'query_string' => $queryString,
            'max_iteration' => $maxIteration,
        ]);
    }

    public function modifier(string $queryString = '', int $offset = 0, int $limit = 50): object
    {
        return $this->call('/modifier', [
            'method' => 'get_modifier',
            'query_string' => $queryString,
            'offset' => $offset,
            'limit' => $limit,
        ]);
    }

    public function modifierValue(string $queryString): object
    {
        return $this->call('/modifier_value', [
            'method' => 'get_modifier_value',
            'query_string' => $queryString,
        ]);
    }

    public function baseCodeByModifier(string $queryString, int $offset = 0, int $limit = 10): object
    {
        return $this->call('/base_code_by_modifier', [
            'method' => 'get_base_code',
            'query_string' => $queryString,
            'offset' => $offset,
            'limit' => $limit,
        ]);
    }
}
