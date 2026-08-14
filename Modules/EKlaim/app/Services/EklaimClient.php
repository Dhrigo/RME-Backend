<?php

namespace Modules\EKlaim\Services;

use Illuminate\Support\Facades\Http;
use RuntimeException;

/**
 * RPC single-endpoint client for E-Klaim's ws.php - every operation is a
 * POST to the SAME url, dispatched by `metadata.method` in the (encrypted)
 * JSON body, per inacbg_manual.txt bagian II/III/IV. The manual's own PHP
 * example sets CURLOPT_POSTFIELDS directly to the encrypted blob (not a
 * form field) despite the x-www-form-urlencoded Content-Type header - ported
 * as-is via Http::withBody().
 */
class EklaimClient
{
    public function __construct(private readonly EklaimCrypto $crypto)
    {
    }

    public function call(string $method, array $data = []): array
    {
        $key = (string) config('eklaim.key');

        $json = json_encode([
            'metadata' => ['method' => $method],
            'data' => $data,
        ]);

        $payload = $this->crypto->encrypt($json, $key);

        $response = Http::withBody($payload, 'application/x-www-form-urlencoded')
            ->post(rtrim((string) config('eklaim.base_url'), '/').'/ws.php')
            ->throw();

        return $this->decodeResponse($response->body(), $key);
    }

    private function decodeResponse(string $body, string $key): array
    {
        // manual: strip the "----BEGIN ENCRYPTED DATA----" / "----END
        // ENCRYPTED DATA----" wrapper lines before base64-decoding.
        $stripped = preg_replace('/----(BEGIN|END) ENCRYPTED DATA----\r?\n?/', '', $body);

        $decrypted = $this->crypto->decrypt($stripped, $key);
        if ($decrypted === null) {
            throw new RuntimeException('E-Klaim response signature mismatch or decryption failed.');
        }

        $decoded = json_decode($decrypted, true);
        if (! is_array($decoded)) {
            throw new RuntimeException('E-Klaim response was not valid JSON after decryption.');
        }

        return $decoded;
    }
}
