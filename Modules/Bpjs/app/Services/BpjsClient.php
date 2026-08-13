<?php

namespace Modules\Bpjs\Services;

use Illuminate\Support\Facades\Http;
use InvalidArgumentException;

/**
 * Shared HTTP client for all Bpjs* family modules (VClaim, Antrean RS/FKTP,
 * Apotek, PCare, i-Care, WS Rekam Medis, Aplicares). Each family has its own
 * base URL + cons_id/secret_key/user_key (config('bpjs.families.<family>')),
 * confirmed distinct via BPJS's own Trust Mark "Base URL" catalog page.
 */
class BpjsClient
{
    public function __construct(
        private readonly BpjsSignature $signature,
        private readonly BpjsCrypto $crypto,
    ) {
    }

    public function family(string $family): array
    {
        $config = config("bpjs.families.{$family}");

        if (! $config) {
            throw new InvalidArgumentException("Unknown BPJS family: {$family}");
        }

        return $config;
    }

    /**
     * Send a request to a BPJS endpoint and decode the response.
     * If the response body carries an encrypted `response` field (VClaim v2.0+
     * style), it's transparently decrypted using the same cons_id/secret_key/
     * timestamp that signed this request — decrypt keys are timestamp-bound,
     * so the signing timestamp and decrypt timestamp must match exactly.
     */
    public function call(string $family, string $method, string $uri, array $data = [], bool $encrypted = false): object
    {
        $config = $this->family($family);
        $headers = $this->signature->headers($config, config('bpjs.timezone'), config('bpjs.signature_add_time'));

        $response = Http::withHeaders($headers)
            ->withOptions(['verify' => app()->environment('production')])
            ->send($method, rtrim($config['base_url'], '/').'/'.ltrim($uri, '/'), [
                'json' => $data ?: null,
            ]);

        $body = json_decode($response->body());

        if ($encrypted && isset($body->response) && is_string($body->response)) {
            $body->response = $this->crypto->decrypt(
                $body->response,
                $config['cons_id'],
                $config['secret_key'],
                $headers['X-timestamp'],
            );
        }

        return $body;
    }
}
