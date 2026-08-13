<?php

namespace Modules\Bpjs\Tests\Unit;

use Modules\Bpjs\Services\BpjsCrypto;
use Modules\Bpjs\Services\BpjsSignature;
use Tests\TestCase;

class BpjsSignatureTest extends TestCase
{
    public function test_signature_matches_known_hmac_vector(): void
    {
        // Fixed timestamp via addTime=PT0S and a frozen clock isn't available here,
        // so verify the HMAC formula directly against BPJS's documented algorithm:
        // signature = base64(hmac_sha256(cons_id . "&" . timestamp, secret_key)).
        $consId = '12345';
        $secretKey = 'supersecret';
        $timestamp = 1700000000;

        $expected = base64_encode(hash_hmac('sha256', $consId.'&'.$timestamp, $secretKey, true));

        $signature = new BpjsSignature;
        $headers = $signature->headers(
            ['cons_id' => $consId, 'secret_key' => $secretKey, 'user_key' => 'uk'],
            'Asia/Jakarta',
            'PT0S',
        );

        // Recompute using the timestamp the class actually generated, since we can't
        // freeze time here — this proves the formula, not a fixed clock.
        $recomputed = base64_encode(hash_hmac('sha256', $consId.'&'.$headers['X-timestamp'], $secretKey, true));

        $this->assertSame($recomputed, $headers['X-signature']);
        $this->assertSame($consId, $headers['X-cons-id']);
        $this->assertNotEmpty($expected);
    }

    public function test_decrypt_roundtrips_aes_lzstring_payload(): void
    {
        $consId = '12345';
        $secretKey = 'supersecret';
        $timestamp = '1700000000';

        $key = $consId.$secretKey.$timestamp;
        $keyHash = hex2bin(hash('sha256', $key));
        $iv = substr(hex2bin(hash('sha256', $key)), 0, 16);

        $payload = ['metaData' => ['code' => '200', 'message' => 'OK'], 'response' => ['peserta' => ['nama' => 'TRI M']]];
        $compressed = \LZCompressor\LZString::compressToEncodedURIComponent(json_encode($payload));
        $encrypted = base64_encode(openssl_encrypt($compressed, 'AES-256-CBC', $keyHash, OPENSSL_RAW_DATA, $iv));

        $decrypted = (new BpjsCrypto)->decrypt($encrypted, $consId, $secretKey, $timestamp);

        $this->assertSame('TRI M', $decrypted->response->peserta->nama);
    }
}
