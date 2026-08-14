<?php

return [
    'name' => 'SatuSehatKptl',

    /*
     * "Master Data API - KPTL" host - kemkes_research_findings_part2.md
     * section 2.3 documents the OAuth2 token endpoint
     * (api-satusehat.kemkes.go.id/oauth2/v1/accesstoken) and the RPC request
     * bodies/paths (/code, /base_code, ...) verbatim, but the collection's
     * {{base_url}} variable value for the KPTL data endpoints themselves was
     * NOT captured during research. No default is set here on purpose -
     * DILARANG karang endpoint host. Must be confirmed (e.g. from the live
     * Postman environment or SATUSEHAT dev portal) and set via env before
     * this module can reach production.
     */
    'base_url' => env('SATUSEHAT_KPTL_BASE_URL'),
];
