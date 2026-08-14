<?php

namespace Modules\BpjsVClaim\Support;

/**
 * Small shared helper for reading BPJS's {"metaData":{"code":"200",...}} envelope
 * and turning it into the local success/error record every write controller in this
 * module needs to persist (mirrors the real hospital workflow: staff read claim status
 * locally instead of re-querying BPJS). Not a generic entity-cloning abstraction - each
 * model keeps its own schema, this just reads/writes the 3 outcome columns they share.
 */
trait RecordsBpjsResult
{
    protected function bpjsMeta(object $bpjsResponse): ?object
    {
        return $bpjsResponse->metaData ?? $bpjsResponse->metadata ?? null;
    }

    protected function bpjsSucceeded(object $bpjsResponse): bool
    {
        $meta = $this->bpjsMeta($bpjsResponse);

        return $meta !== null && (string) $meta->code === '200';
    }

    protected function bpjsMessage(object $bpjsResponse): ?string
    {
        return $this->bpjsMeta($bpjsResponse)->message ?? null;
    }

    protected function bpjsResponseArray(object $bpjsResponse): array
    {
        return json_decode(json_encode($bpjsResponse), true);
    }
}
