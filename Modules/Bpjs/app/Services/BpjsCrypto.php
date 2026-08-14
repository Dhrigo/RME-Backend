<?php

namespace Modules\Bpjs\Services;

use LZCompressor\LZString;

/**
 * BPJS uses TWO DIFFERENT AES-256-CBC schemes depending on the family —
 * confirmed by reading both original ZF2 source trees, not guessed:
 *
 * 1. VClaim v2.0+ (decrypt/encrypt): key = cons_id+secret_key+X-timestamp,
 *    OPENSSL_RAW_DATA padding, LZString compression. Ported from
 *    BPJService\BaseService::decrypt().
 * 2. SmartClaim/RekamMedis (decryptGzip/encryptGzip): key =
 *    cons_id+secret_key+kodeBpjs (hospital's own BPJS facility code, NOT
 *    timestamp), default PKCS7 padding (openssl handles base64 internally
 *    since OPENSSL_RAW_DATA is not passed), gzcompress/gzuncompress instead
 *    of LZString. Ported from BPJS\SmartClaim\RPCResource::encrypt()/decrypt().
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

    /**
     * $kodeBpjs is the hospital's own BPJS facility/provider code
     * (config('bpjs.koders')), not a per-request value.
     */
    public function encryptGzip(string $plaintext, string $consId, string $secretKey, string $kodeBpjs): string
    {
        $key = $consId.$secretKey.$kodeBpjs;
        $keyHash = hex2bin(hash('sha256', $key));
        $iv = substr(hex2bin(hash('sha256', $key)), 0, 16);

        $gzipped = gzcompress($plaintext, 9);
        $base64Gzipped = base64_encode($gzipped);

        // openssl_encrypt() without OPENSSL_RAW_DATA returns base64 text already.
        return openssl_encrypt($base64Gzipped, 'AES-256-CBC', $keyHash, 0, $iv);
    }

    public function decryptGzip(string $encrypted, string $consId, string $secretKey, string $kodeBpjs): string
    {
        $key = $consId.$secretKey.$kodeBpjs;
        $keyHash = hex2bin(hash('sha256', $key));
        $iv = substr(hex2bin(hash('sha256', $key)), 0, 16);

        // openssl_decrypt() without OPENSSL_RAW_DATA base64-decodes internally.
        $base64Gzipped = openssl_decrypt($encrypted, 'AES-256-CBC', $keyHash, 0, $iv);

        return gzuncompress(base64_decode($base64Gzipped));
    }
}
