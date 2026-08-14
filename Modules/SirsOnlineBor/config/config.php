<?php

return [
    'name' => 'SirsOnlineBor',

    /*
     * SIRANAP / RS Online real-time bed availability push. SEPARATE domain
     * and auth scheme from SATUSEHAT and SISRUTE (verified live,
     * kemkes_research_findings_part3.md Task 1): sirs.kemkes.go.id/fo, per-
     * request headers X-rs-id / X-pass / X-Timestamp (no OAuth2, no HMAC
     * signature - just the hospital's assigned bridging credentials).
     */
    'base_url' => env('SIRS_ONLINE_BOR_BASE_URL', 'https://sirs.kemkes.go.id/fo'),
    'rs_id' => env('SIRS_ONLINE_BOR_RS_ID'), // Kode Faskes
    'password' => env('SIRS_ONLINE_BOR_PASSWORD'), // bridging password
];
