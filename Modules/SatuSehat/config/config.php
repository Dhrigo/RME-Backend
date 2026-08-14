<?php

return [
    'name' => 'SatuSehat',

    /*
     * SATUSEHAT (IHS / Indonesia Health Services) platform credentials.
     * Single OAuth2 client_credentials grant shared across ALL SatuSehat* family
     * modules (RawatJalan, RawatInap, Igd, Farmasi, MasterData, Kptl, IbuAnak,
     * Anak, PtmRegistry, Spesialistik, PenyakitMenular, Klaim) — confirmed via
     * live Postman public workspace (satusehat/satusehat-public): one
     * {{auth_url}}/accesstoken?grant_type=client_credentials token is reused
     * for every FHIR resource collection, unlike BPJS which issues separate
     * cons_id/secret_key per product family.
     */
    'auth_url' => env('SATUSEHAT_AUTH_URL', 'https://api-satusehat-stg.kemkes.go.id/oauth2/v1'),
    'base_url' => env('SATUSEHAT_BASE_URL', 'https://api-satusehat-stg.kemkes.go.id/fhir-r4/v1'),
    'client_id' => env('SATUSEHAT_CLIENT_ID'),
    'client_secret' => env('SATUSEHAT_CLIENT_SECRET'),

    // This hospital's own SATUSEHAT-registered Organization resource ID,
    // required as serviceProvider/organization reference on nearly every
    // resource this hospital submits.
    'organization_id' => env('SATUSEHAT_ORGANIZATION_ID'),
];
