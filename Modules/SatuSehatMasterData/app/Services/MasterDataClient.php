<?php

namespace Modules\SatuSehatMasterData\Services;

use Illuminate\Support\Facades\Http;
use Modules\SatuSehat\Services\SatuSehatClient;

/**
 * Read-only lookup client for the SATUSEHAT "Master Data API - APIGEE
 * (v2.0)" collection (Kewilayahan, Master Sarana Index, KFA) - see
 * kemkes_research_findings_part2.md section 2.2. Reuses the shared
 * SatuSehatClient purely for its OAuth2 token() cache (this family lives on
 * a different host/path shape than the FHIR base_url, so SatuSehatClient::
 * get() itself isn't reused). Designed to be injected by OTHER SatuSehat*
 * family modules that need to validate a code before submitting (e.g.
 * KFA code lookups from Farmasi) - kept intentionally generic/query-param
 * passthrough rather than hard-coding specific consumers.
 */
class MasterDataClient
{
    public function __construct(private readonly SatuSehatClient $client)
    {
    }

    protected function baseUrl(): string
    {
        return rtrim(config('satusehatmasterdata.base_url'), '/');
    }

    protected function get(string $path, array $query = []): object
    {
        return Http::withToken($this->client->token())
            ->acceptJson()
            ->get($this->baseUrl().$path, $query)
            ->throw()
            ->object();
    }

    protected function post(string $path, array $body): object
    {
        return Http::withToken($this->client->token())
            ->acceptJson()
            ->post($this->baseUrl().$path, $body)
            ->throw()
            ->object();
    }

    // -- Master Kewilayahan V1 --

    public function provinces(): object
    {
        return $this->get('/masterdata/v1/provinces');
    }

    public function cities(array $query = []): object
    {
        return $this->get('/masterdata/v1/cities', $query);
    }

    public function districts(array $query = []): object
    {
        return $this->get('/masterdata/v1/districts', $query);
    }

    public function subDistricts(array $query = []): object
    {
        return $this->get('/masterdata/v1/sub-districts', $query);
    }

    // -- Master Kewilayahan V2 (adds province_codes/code/pagination) --

    public function provincesV2(array $query = []): object
    {
        return $this->get('/masterdata/v2/provinces', $query);
    }

    public function citiesV2(array $query = []): object
    {
        return $this->get('/masterdata/v2/cities', $query);
    }

    public function districtsV2(array $query = []): object
    {
        return $this->get('/masterdata/v2/districts', $query);
    }

    public function subDistrictsV2(array $query = []): object
    {
        return $this->get('/masterdata/v2/sub-districts', $query);
    }

    // -- Master Sarana Index V1 --

    public function sarana(array $query = []): object
    {
        return $this->get('/masterdata/v1/sarana', $query);
    }

    // -- KFA --

    public function kfaPriceJkn(array $query): object
    {
        return $this->get('/kfa/farmalkes-price-jkn', $query);
    }

    public function kfaProductV2(string $identifier, string $code, ?string $templateCode = null): object
    {
        return $this->get('/kfa-v2/products', array_filter([
            'identifier' => $identifier,
            'code' => $code,
            'template_code' => $templateCode,
        ]));
    }

    public function kfaProductsAllV2(array $query): object
    {
        return $this->get('/kfa-v2/products/all', $query);
    }

    public function kfaAlkesTemplates(array $body): object
    {
        return $this->post('/kfa-v3/alkes/template', $body);
    }

    public function kfaAlkesProducts(array $body): object
    {
        return $this->post('/kfa-v3/alkes/products', $body);
    }
}
