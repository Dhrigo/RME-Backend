<?php

namespace Modules\Bpjs\Services;

use LZCompressor\LZString;

/**
 * Decrypts BPJS API response bodies encrypted with AES-256-CBC + LZString
 * compression, per VClaim v2.0+ spec. Key material is derived per-request
 * from cons_id + secret_key + the X-timestamp sent on that same request —
 * ported from the original ZF2 BPJService\BaseService::decrypt().
 */
class BpjsCrypto
{
    public function decrypt(string $encrypted, string $consId, string $secretKey, string $timestamp): mixed
    {
        $key = $consId.$secretKey.$timestamp;
        $keyHash = hex2bin(hash('sha256', $key));
        $iv = substr(hex2bin(hash('sha256', $key)), 0, 16);

        $decrypted = openssl_decrypt(
            base64_decode($encrypted),
            'AES-256-CBC',
            $keyHash,
            OPENSSL_RAW_DATA,
            $iv
        );

        $json = LZString::decompressFromEncodedURIComponent($decrypted);

        return json_decode($json);
    }
}
