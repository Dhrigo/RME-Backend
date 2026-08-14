<?php

namespace Modules\EKlaim\Services;

use RuntimeException;

/**
 * Ported field-for-field from inacbg_manual.txt bagian III (ENKRIPSI/DEKRIPSI)
 * and bagian XI's PHP reference implementation (inacbg_encrypt/inacbg_decrypt):
 *
 *   encrypted = openssl_encrypt(data, aes-256-cbc, key, OPENSSL_RAW_DATA, iv)
 *   signature = substr(hash_hmac('sha256', encrypted, key, true), 0, 10)
 *   wire      = chunk_split(base64_encode(signature . iv . encrypted))
 *
 * $key is passed in as the raw 64-hex-char string configured in E-Klaim's
 * admin UI; hex2bin() here turns it into the 32-byte binary key.
 */
class EklaimCrypto
{
    public function encrypt(string $data, string $hexKey): string
    {
        $key = $this->binKey($hexKey);

        $ivSize = openssl_cipher_iv_length('aes-256-cbc');
        $iv = random_bytes($ivSize);

        $encrypted = openssl_encrypt($data, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
        if ($encrypted === false) {
            throw new RuntimeException('E-Klaim encryption failed.');
        }

        $signature = substr(hash_hmac('sha256', $encrypted, $key, true), 0, 10);

        return chunk_split(base64_encode($signature.$iv.$encrypted));
    }

    /**
     * Returns null on signature mismatch (mirrors the manual's
     * "SIGNATURE_NOT_MATCH" sentinel rather than throwing, so callers can
     * distinguish tampering/corruption from a transport error).
     */
    public function decrypt(string $wire, string $hexKey): ?string
    {
        $key = $this->binKey($hexKey);
        $ivSize = openssl_cipher_iv_length('aes-256-cbc');

        $decoded = base64_decode(trim($wire));
        $signature = substr($decoded, 0, 10);
        $iv = substr($decoded, 10, $ivSize);
        $encrypted = substr($decoded, $ivSize + 10);

        $calcSignature = substr(hash_hmac('sha256', $encrypted, $key, true), 0, 10);

        if (! hash_equals($signature, $calcSignature)) {
            return null;
        }

        $decrypted = openssl_decrypt($encrypted, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);

        return $decrypted === false ? null : $decrypted;
    }

    private function binKey(string $hexKey): string
    {
        $key = hex2bin($hexKey);
        if (mb_strlen($key, '8bit') !== 32) {
            throw new RuntimeException('E-Klaim key must be a 256-bit (32-byte / 64 hex char) key.');
        }

        return $key;
    }
}
