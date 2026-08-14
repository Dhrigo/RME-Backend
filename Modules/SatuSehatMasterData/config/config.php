<?php

return [
    'name' => 'SatuSehatMasterData',

    /*
     * Master Data API - APIGEE (v2.0) base host, confirmed in
     * kemkes_research_findings_part2.md section 2.2 ("Environments
     * Documented: STAGING / PROD"). Distinct from the FHIR base_url in the
     * SatuSehat kernel config - this family lives on the plain APIGEE host,
     * not under /fhir-r4/v1. Auth token is still the shared SatuSehat OAuth2
     * client_credentials token (via SatuSehatClient::token()).
     */
    'base_url' => env('SATUSEHAT_MASTERDATA_BASE_URL', 'https://api-satusehat-stg.kemkes.go.id'),
];
