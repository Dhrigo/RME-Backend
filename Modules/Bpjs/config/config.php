<?php

return [
    'name' => 'Bpjs',

    /*
     * Per-family credentials. Each BPJS product (VClaim, Antrean RS, Antrean FKTP,
     * Apotek, PCare, i-Care, WS Rekam Medis, Aplicares) issues its own cons_id/secret_key/
     * user_key pair and has its own base URL — confirmed via BPJS's own Trust Mark
     * "Base URL Web Service Development" catalog page, not shared across families.
     */
    'families' => [
        'vclaim' => [
            'base_url' => env('BPJS_VCLAIM_BASE_URL', 'https://apijkn-dev.bpjs-kesehatan.go.id/vclaim-rest-dev'),
            'cons_id' => env('BPJS_VCLAIM_CONS_ID'),
            'secret_key' => env('BPJS_VCLAIM_SECRET_KEY'),
            'user_key' => env('BPJS_VCLAIM_USER_KEY'),
        ],
        'antrean_rs' => [
            'base_url' => env('BPJS_ANTREAN_RS_BASE_URL', 'https://apijkn-dev.bpjs-kesehatan.go.id/antreanrs_dev'),
            'cons_id' => env('BPJS_ANTREAN_RS_CONS_ID'),
            'secret_key' => env('BPJS_ANTREAN_RS_SECRET_KEY'),
            'user_key' => env('BPJS_ANTREAN_RS_USER_KEY'),
        ],
        'antrean_fktp' => [
            'base_url' => env('BPJS_ANTREAN_FKTP_BASE_URL', 'https://apijkn-dev.bpjs-kesehatan.go.id/antreanfktp_dev'),
            'cons_id' => env('BPJS_ANTREAN_FKTP_CONS_ID'),
            'secret_key' => env('BPJS_ANTREAN_FKTP_SECRET_KEY'),
            'user_key' => env('BPJS_ANTREAN_FKTP_USER_KEY'),
        ],
        'apotek' => [
            'base_url' => env('BPJS_APOTEK_BASE_URL', 'https://apijkn-dev.bpjs-kesehatan.go.id/apotek-rest-dev'),
            'cons_id' => env('BPJS_APOTEK_CONS_ID'),
            'secret_key' => env('BPJS_APOTEK_SECRET_KEY'),
            'user_key' => env('BPJS_APOTEK_USER_KEY'),
        ],
        'pcare' => [
            'base_url' => env('BPJS_PCARE_BASE_URL', 'https://apijkn-dev.bpjs-kesehatan.go.id/pcare-rest-dev'),
            'cons_id' => env('BPJS_PCARE_CONS_ID'),
            'secret_key' => env('BPJS_PCARE_SECRET_KEY'),
            'user_key' => env('BPJS_PCARE_USER_KEY'),
        ],
        'icare' => [
            'base_url' => env('BPJS_ICARE_BASE_URL', 'https://apijkn-dev.bpjs-kesehatan.go.id/ihs_dev'),
            'cons_id' => env('BPJS_ICARE_CONS_ID'),
            'secret_key' => env('BPJS_ICARE_SECRET_KEY'),
            'user_key' => env('BPJS_ICARE_USER_KEY'),
        ],
        'rekam_medis' => [
            'base_url' => env('BPJS_REKAM_MEDIS_BASE_URL', 'https://apijkn-dev.bpjs-kesehatan.go.id/erekammedis_dev'),
            'cons_id' => env('BPJS_REKAM_MEDIS_CONS_ID'),
            'secret_key' => env('BPJS_REKAM_MEDIS_SECRET_KEY'),
            'user_key' => env('BPJS_REKAM_MEDIS_USER_KEY'),
        ],
        'aplicares' => [
            'base_url' => env('BPJS_APLICARES_BASE_URL', 'https://apijkn-dev.bpjs-kesehatan.go.id/aplicares_dev'),
            'cons_id' => env('BPJS_APLICARES_CONS_ID'),
            'secret_key' => env('BPJS_APLICARES_SECRET_KEY'),
            'user_key' => env('BPJS_APLICARES_USER_KEY'),
        ],
        // SmartClaim (rekammedis/insert): its own consumer credentials, distinct
        // from icare/rekam_medis above — confirmed via original ZF2 source
        // (BPJS\SmartClaim\RPCResource reads $config['services']['BPJService']['smartclaim']
        // as its own config block). Uses BpjsCrypto::encryptGzip/decryptGzip, not
        // the LZString scheme the other families use.
        'smartclaim' => [
            'base_url' => env('BPJS_SMARTCLAIM_BASE_URL'),
            'cons_id' => env('BPJS_SMARTCLAIM_CONS_ID'),
            'secret_key' => env('BPJS_SMARTCLAIM_SECRET_KEY'),
            'user_key' => env('BPJS_SMARTCLAIM_USER_KEY'),
        ],
    ],

    // kode PPK/provider rumah sakit sendiri (dikirim di setiap request ke BPJS)
    'koders' => env('BPJS_PROVIDER_CODE'),

    'timezone' => 'Asia/Jakarta',

    // signature timestamp offset dari waktu lokal, format ISO 8601 duration
    'signature_add_time' => 'PT0S',
];
