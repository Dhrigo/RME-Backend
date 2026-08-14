<?php

namespace Modules\Sitb\Services;

use Illuminate\Support\Facades\Http;

/**
 * HTTP client for the SITB push-outbound webservice. Ported 1:1 from the ZF2
 * SITBController::onBeforeSendRequest() + kirimAction(): headers X-rs-id/
 * X-pass/X-Timestamp, POST to the relative "senddata" action under
 * config('sitb.base_url').
 */
class SitbClient
{
    public function send(array $data): object
    {
        $url = rtrim(config('sitb.base_url'), '/').'/senddata';

        $response = Http::withHeaders([
            'X-rs-id' => config('sitb.id'),
            'X-pass' => config('sitb.key'),
            'X-Timestamp' => (string) now('UTC')->getTimestamp(),
        ])->post($url, $data);

        return $response->throw()->object();
    }
}
