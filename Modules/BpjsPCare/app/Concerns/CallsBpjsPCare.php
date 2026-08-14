<?php

namespace Modules\BpjsPCare\Concerns;

use Modules\Bpjs\Services\BpjsClient;
use Throwable;

/**
 * Shared call+interpret helper for the transactional PCare controllers
 * (Kunjungan, Pendaftaran, MCU, Alergi, Prognosa, Skrinning, Tindakan).
 * Every one of them needs the same "call BPJS, read metaData.code, and
 * hand back a success/response/error triple" shape before persisting the
 * local record — this is infrastructure reuse, not entity-schema cloning.
 */
trait CallsBpjsPCare
{
    /**
     * @return array{success: bool, response: object|null, error: string|null}
     */
    protected function pcareCall(BpjsClient $client, string $method, string $uri, array $payload = []): array
    {
        try {
            $result = $client->call('pcare', $method, $uri, $payload);
        } catch (Throwable $e) {
            return ['success' => false, 'response' => null, 'error' => $e->getMessage()];
        }

        $code = $result->metaData->code ?? null;
        $success = $code === '200';

        return [
            'success' => $success,
            'response' => $result,
            'error' => $success ? null : ($result->metaData->message ?? 'Unknown BPJS PCare error'),
        ];
    }
}
