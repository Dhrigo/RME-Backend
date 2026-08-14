<?php

return [
    'name' => 'Sitb',

    /*
     * SITB (Sistem Informasi Tuberkulosis) push-outbound webservice.
     * Ported from the ZF2 source (module/Kemkes/src/Kemkes/V2/Rpc/SITB/
     * SITBController.php): auth headers X-rs-id/X-pass/X-Timestamp (own
     * scheme, NOT the HMAC used by BPJS/Sisrute), and the send call targets
     * a RELATIVE path "senddata" under the configured base_url - not an
     * absolute sitb.kemkes.go.id/app URL (that domain is the login portal,
     * not the webservice host).
     */
    'base_url' => env('SITB_BASE_URL'),
    'id' => env('SITB_ID'), // X-rs-id
    'key' => env('SITB_KEY'), // X-pass
];
