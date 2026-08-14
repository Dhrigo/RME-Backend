<?php

namespace Modules\SisruteResumeMedis\Services;

use Modules\Sisrute\Services\SisruteClient;
use Modules\SisruteResumeMedis\Models\ResumeMedis;

/**
 * SISRUTE ResumeMedis-v1 (GET/POST /resumemedis/resume). Reuses the shared
 * Modules\Sisrute\Services\SisruteClient HMAC client - same host, same auth
 * scheme as SISRUTE core, so no HTTP/signature logic is reimplemented here.
 */
class ResumeMedisService
{
    public function __construct(private readonly SisruteClient $client)
    {
    }

    public function send(array $data): ResumeMedis
    {
        $local = ResumeMedis::create([
            'payload' => $data,
            'status' => 'pending',
        ]);

        try {
            $response = $this->client->call('POST', 'resumemedis/resume', $data);
            $local->update([
                'response' => json_decode(json_encode($response), true),
                'status' => 'sent',
            ]);
        } catch (\Throwable $e) {
            $local->update([
                'status' => 'failed',
                'error_message' => $e->getMessage(),
            ]);
        }

        return $local->fresh();
    }

    public function get(array $query = []): object
    {
        return $this->client->call('GET', 'resumemedis/resume', $query);
    }
}
