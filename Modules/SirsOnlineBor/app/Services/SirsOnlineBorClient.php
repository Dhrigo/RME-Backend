<?php

namespace Modules\SirsOnlineBor\Services;

use Illuminate\Support\Facades\Http;

/**
 * HTTP client for SIRANAP / RS Online bed-availability endpoint
 * (sirs.kemkes.go.id/fo/index.php/Fasyankes). Auth is per-request headers
 * X-rs-id/X-pass/X-Timestamp - verified live, kemkes_research_findings_part3.md
 * Task 1. This is its OWN system/domain, distinct from SATUSEHAT (OAuth2)
 * and SISRUTE (HMAC signature) - do not reuse those clients here.
 */
class SirsOnlineBorClient
{
    public function call(string $method, array $data = []): object
    {
        $url = rtrim(config('sirsonlinebor.base_url'), '/').'/index.php/Fasyankes';

        $request = Http::withHeaders([
            'X-rs-id' => config('sirsonlinebor.rs_id'),
            'X-pass' => config('sirsonlinebor.password'),
            'X-Timestamp' => (string) now('UTC')->getTimestamp(),
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ]);

        $response = match (strtoupper($method)) {
            'GET' => $request->get($url, $data),
            'POST' => $request->post($url, $data),
            'PUT' => $request->put($url, $data),
            'DELETE' => $request->delete($url, $data),
            default => throw new \InvalidArgumentException("Unsupported HTTP method: {$method}"),
        };

        return $response->throw()->object();
    }
}
