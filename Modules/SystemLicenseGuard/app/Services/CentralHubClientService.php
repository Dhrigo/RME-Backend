<?php

namespace Modules\SystemLicenseGuard\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Modules\SystemLicenseGuard\Models\SystemLicense;

class CentralHubClientService
{
    public function __construct(
        protected LicenseVerifierService $verifier,
        protected HardwareFingerprintService $fingerprintService
    ) {}

    public function activateOnline(string $licenseKey, ?string $centralUrl = null): array
    {
        $url = rtrim($centralUrl ?: config('license.central_hub_url'), '/');
        $hwid = $this->fingerprintService->getFingerprint();

        $endpoint = "{$url}/api/v1/licenses/activate";

        try {
            $response = Http::timeout(config('license.central_hub_timeout', 10))
                ->post($endpoint, [
                    'license_key' => $licenseKey,
                    'hardware_id' => $hwid,
                    'hostname' => gethostname(),
                    'app_version' => config('app.version', '1.0.0'),
                ]);

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'message' => $response->json('message') ?: 'Central SaaS server rejected activation (' . $response->status() . ')',
                ];
            }

            $signedToken = $response->json('token');
            if (!$signedToken) {
                return [
                    'success' => false,
                    'message' => 'Central server response did not contain a signed token.',
                ];
            }

            $license = $this->verifier->activateToken($signedToken);

            return [
                'success' => true,
                'message' => 'Instance successfully activated with central SaaS hub.',
                'license' => $license,
            ];
        } catch (\Throwable $e) {
            Log::error('Central hub activation failed: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Failed to connect to central SaaS server: ' . $e->getMessage(),
            ];
        }
    }

    public function sendHeartbeat(): array
    {
        $license = $this->verifier->getActiveLicense();
        if (!$license) {
            return ['success' => false, 'message' => 'No active license to heartbeat.'];
        }

        $url = rtrim(config('license.central_hub_url'), '/');
        $endpoint = "{$url}/api/v1/licenses/heartbeat";

        $payload = [
            'instance_id' => $license->instance_id,
            'client_code' => $license->client_code,
            'license_key' => $license->license_key,
            'hardware_id' => $this->fingerprintService->getFingerprint(),
            'app_version' => config('app.version', '1.0.0'),
            'php_version' => PHP_VERSION,
            'timestamp' => time(),
        ];

        try {
            $response = Http::timeout(config('license.central_hub_timeout', 10))
                ->post($endpoint, $payload);

            if ($response->successful()) {
                $license->update(['last_synced_at' => now()]);

                $newToken = $response->json('token');
                if ($newToken) {
                    $this->verifier->activateToken($newToken);
                }

                if ($response->json('status') === 'suspended') {
                    $license->update(['status' => 'suspended']);
                }

                return [
                    'success' => true,
                    'message' => 'Heartbeat acknowledged by central SaaS server.',
                ];
            }

            return [
                'success' => false,
                'message' => 'Central server returned error: ' . $response->status(),
            ];
        } catch (\Throwable $e) {
            return [
                'success' => false,
                'message' => 'Heartbeat connection error: ' . $e->getMessage(),
            ];
        }
    }
}
