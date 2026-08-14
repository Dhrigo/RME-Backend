<?php

return [
    'name' => 'EKlaim',

    /*
     * E-Klaim / INA-CBG web service (RPC single-endpoint, "ws.php"). Own
     * crypto scheme entirely distinct from BPJS/SATUSEHAT/SISRUTE - verified
     * from the official manual (inacbg_manual.txt bagian III ENKRIPSI):
     * ONE symmetric 256-bit key (hex string, 64 chars), generated manually
     * in the E-Klaim admin UI - NOT a cons_id/secret_key pair.
     */
    'base_url' => env('EKLAIM_BASE_URL'), // e.g. http://<host>/E-Klaim
    'key' => env('EKLAIM_KEY'), // 64 hex chars = 256-bit key
];
