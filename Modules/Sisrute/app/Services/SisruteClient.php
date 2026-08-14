<?php

namespace Modules\Sisrute\Services;

use Illuminate\Support\Facades\Http;

/**
 * Shared HMAC-signed HTTP client for the SISRUTE family (Sisrute core,
 * RsOnline, SisruteResumeMedis). SISRUTE is a SEPARATE system from SATUSEHAT
 * with its own auth scheme - do NOT reuse Modules\SatuSehat\Services\SatuSehatClient
 * here (no OAuth2 token exchange in this API, just per-request headers).
 *
 * Signature algorithm verified live at
 * dvlp-sisrute.kemkes.go.id/api/apigility/documentation/authentication
 * (kemkes_research_findings_part2.md section 1.1):
 *   $pass = hash('sha256', $id.$pass);
 *   $timestamp = (new DateTime(null, new DateTimeZone("UTC")))->getTimestamp();
 *   $key = $id."&".$timestamp;
 *   $signature = base64_encode(hash_hmac("sha256", $key, $pass, true));
 */
class SisruteClient
{
    private function signature(int $timestamp): string
    {
        $id = (string) config('sisrute.cons_id');
        $password = (string) config('sisrute.password');

        $hashedPass = hash('sha256', $id.$password);
        $key = $id.'&'.$timestamp;

        return base64_encode(hash_hmac('sha256', $key, $hashedPass, true));
    }

    /**
     * Fire a signed request against the SISRUTE API. $uri is relative to
     * config('sisrute.base_url'), e.g. "rujukan/rujukan".
     */
    public function call(string $method, string $uri, array $data = []): object
    {
        $timestamp = now('UTC')->getTimestamp();

        $request = Http::withHeaders([
            'X-cons-id' => config('sisrute.cons_id'),
            'X-Timestamp' => (string) $timestamp,
            'X-signature' => $this->signature($timestamp),
            'Content-Type' => 'application/json',
        ]);

        $url = rtrim(config('sisrute.base_url'), '/').'/'.ltrim($uri, '/');

        $response = match (strtoupper($method)) {
            'GET' => $request->get($url, $data),
            'POST' => $request->post($url, $data),
            'PUT' => $request->put($url, $data),
            'PATCH' => $request->patch($url, $data),
            'DELETE' => $request->delete($url, $data),
            default => throw new \InvalidArgumentException("Unsupported HTTP method: {$method}"),
        };

        return $response->throw()->object();
    }
}
