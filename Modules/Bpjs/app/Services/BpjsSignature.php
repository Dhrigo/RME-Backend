<?php

namespace Modules\Bpjs\Services;

use DateTime;
use DateTimeZone;

/**
 * HMAC-SHA256 request signature per BPJS VClaim/Antrean/Apotek/PCare spec:
 * signature = base64(hmac_sha256(cons_id . "&" . timestamp, secret_key)).
 * Ported from the original ZF2 BPJService\BaseService::setHeaderSignature().
 */
class BpjsSignature
{
    public function headers(array $family, string $timezone, string $addTime = 'PT0S'): array
    {
        $dt = new DateTime('now', new DateTimeZone($timezone));
        $dt->modify($this->intervalToModifier($addTime));
        $timestamp = $dt->getTimestamp();

        $signature = base64_encode(
            hash_hmac('sha256', $family['cons_id'].'&'.$timestamp, $family['secret_key'], true)
        );

        return [
            'X-cons-id' => $family['cons_id'],
            'X-timestamp' => (string) $timestamp,
            'X-signature' => $signature,
            'user_key' => $family['user_key'],
            'Accept' => 'application/json',
        ];
    }

    private function intervalToModifier(string $isoDuration): string
    {
        if ($isoDuration === 'PT0S' || $isoDuration === '') {
            return '+0 seconds';
        }

        $interval = new \DateInterval($isoDuration);
        $sign = $interval->invert ? '-' : '+';

        return sprintf('%s%d seconds', $sign, $interval->s + $interval->i * 60 + $interval->h * 3600);
    }
}
