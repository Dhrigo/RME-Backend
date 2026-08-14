<?php

namespace Modules\SatuSehat\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Modules\SatuSehat\Models\SatuSehatStagingSubmission;

/**
 * Shared FHIR client for all SatuSehat* family modules (RawatJalan, RawatInap,
 * Igd, Farmasi, MasterData, Kptl, IbuAnak, Anak, PtmRegistry, Spesialistik,
 * PenyakitMenular, Klaim). Unlike BPJS, SATUSEHAT issues ONE OAuth2
 * client_credentials token shared across every resource collection — confirmed
 * via the live public Postman workspace's "00. FHIR Resource - Contoh
 * Penggunaan / O-Auth2" folder (POST {{auth_url}}/accesstoken?grant_type=
 * client_credentials, form body client_id + client_secret).
 */
class SatuSehatClient
{
    /**
     * Fetch (and cache) the bearer token. SATUSEHAT tokens are short-lived
     * (expires_in seconds returned by the token endpoint); cached with a
     * safety margin so a request never fires with an about-to-expire token.
     */
    public function token(): string
    {
        $cached = Cache::get('satusehat.access_token');

        if ($cached) {
            return $cached;
        }

        $response = Http::asForm()->post(
            rtrim(config('satusehat.auth_url'), '/').'/accesstoken',
            [
                'grant_type' => 'client_credentials',
                'client_id' => config('satusehat.client_id'),
                'client_secret' => config('satusehat.client_secret'),
            ]
        )->throw();

        $body = $response->json();

        Cache::put('satusehat.access_token', $body['access_token'], ($body['expires_in'] ?? 3600) - 60);

        return $body['access_token'];
    }

    /**
     * Direct read-through GET (no staging needed — reads aren't retried, they're
     * just re-issued by the caller).
     */
    public function get(string $resourceType, ?string $id = null, array $query = []): object
    {
        $uri = $id ? "{$resourceType}/{$id}" : $resourceType;

        $response = Http::withToken($this->token())
            ->acceptJson()
            ->get(rtrim(config('satusehat.base_url'), '/').'/'.$uri, $query)
            ->throw();

        return $response->object();
    }

    /**
     * Enqueue a resource/Bundle for submission (staging row, status=pending),
     * then attempt to send it immediately. On failure the row stays
     * pending/failed for the retry job — the caller never loses the event even
     * if SATUSEHAT is down or the token just expired.
     */
    public function submit(string $resourceType, array $payload, string $sourceType, int $sourceId): SatuSehatStagingSubmission
    {
        $submission = SatuSehatStagingSubmission::create([
            'resource_type' => $resourceType,
            'source_type' => $sourceType,
            'source_id' => $sourceId,
            'payload' => $payload,
            'status' => 'pending',
        ]);

        $this->send($submission);

        return $submission->fresh();
    }

    /**
     * Attempt to actually POST a staged submission. Used both by submit() for
     * the first-try and by the scheduled retry job for anything still
     * pending/failed.
     */
    public function send(SatuSehatStagingSubmission $submission): void
    {
        try {
            $response = Http::withToken($this->token())
                ->acceptJson()
                ->post(
                    rtrim(config('satusehat.base_url'), '/').'/'.$submission->resource_type,
                    $submission->payload
                )
                ->throw();

            $submission->update([
                'satusehat_id' => $response->json('id'),
                'status' => 'sent',
                'sent_at' => now(),
                'attempts' => $submission->attempts + 1,
            ]);
        } catch (\Throwable $e) {
            $submission->update([
                'status' => 'failed',
                'last_error' => $e->getMessage(),
                'attempts' => $submission->attempts + 1,
            ]);
        }
    }
}
