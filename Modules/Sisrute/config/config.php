<?php

return [
    'name' => 'Sisrute',

    /*
     * SISRUTE (Sistem Informasi Rujukan Terintegrasi) - a system SEPARATE
     * from SATUSEHAT, own HMAC auth scheme (no OAuth2 token exchange).
     * Verified live at dvlp-sisrute.kemkes.go.id/api/apigility/documentation
     * (kemkes_research_findings_part2.md section 1.1 Authentication):
     * signature = base64(hash_hmac('sha256', "{id}&{timestamp}", hash('sha256', id.pass), true))
     */
    'base_url' => env('SISRUTE_BASE_URL', 'https://dvlp-sisrute.kemkes.go.id/api'),
    'cons_id' => env('SISRUTE_CONS_ID'),
    'password' => env('SISRUTE_PASSWORD'),
];
