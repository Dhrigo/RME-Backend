<?php

namespace Modules\SystemLicenseGuard\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Modules\SystemLicenseGuard\Models\SystemLicense;
use Modules\SystemLicenseGuard\Models\SystemLicenseAuditLog;
use Modules\SystemLicenseGuard\Models\SystemLicenseWatermark;

class LicenseVerifierService
{
    public function __construct(
        protected HardwareFingerprintService $fingerprintService
    ) {}

    public function getActiveLicense(): ?SystemLicense
    {
        try {
            return SystemLicense::query()
                ->where('status', 'active')
                ->latest('id')
                ->first();
        } catch (\Throwable) {
            return null;
        }
    }

    public function verify(): array
    {
        $license = $this->getActiveLicense();

        if (!$license) {
            return [
                'valid' => false,
                'code' => 'NO_LICENSE',
                'message' => 'No active license found on this instance.',
                'license' => null,
            ];
        }

        // 1. Anti-Clock Rollback Check
        if (config('license.enable_clock_tamper_detection', true)) {
            $clockOk = $this->checkAndRecordClock();
            if (!$clockOk) {
                $license->update(['status' => 'tampered']);
                $this->audit('clock_tamper_detected', ['message' => 'System clock was set backwards']);

                return [
                    'valid' => false,
                    'code' => 'CLOCK_TAMPERED',
                    'message' => 'System clock manipulation detected. Instance is locked.',
                    'license' => $license,
                ];
            }
        }

        // 2. Hardware Fingerprint Check
        $hwid = $this->fingerprintService->getFingerprint();
        if (config('license.strict_hardware_binding', true)) {
            if (!$this->fingerprintService->matches($license->hardware_id)) {
                $this->audit('fingerprint_mismatch', [
                    'expected' => $license->hardware_id,
                    'actual' => $hwid,
                ]);

                return [
                    'valid' => false,
                    'code' => 'HARDWARE_MISMATCH',
                    'message' => 'Hardware fingerprint does not match the active license.',
                    'license' => $license,
                ];
            }
        }

        // 3. Local Database Integrity Check (HMAC)
        if (!$license->verifyLocalIntegrity($hwid)) {
            $license->update(['status' => 'tampered']);
            $this->audit('db_tamper_detected', ['message' => 'Local database license record modified']);

            return [
                'valid' => false,
                'code' => 'DB_TAMPERED',
                'message' => 'License database integrity failure. Record was modified directly.',
                'license' => $license,
            ];
        }

        // 4. Cryptographic Signature Verification (RSA-SHA256)
        $rawSignature = base64_decode($license->digital_signature, true) ?: $license->digital_signature;
        $sigValid = $this->verifySignature($license->token_payload, $rawSignature);
        if (!$sigValid) {
            $license->update(['status' => 'tampered']);
            $this->audit('invalid_signature', ['message' => 'RSA signature verification failed']);

            return [
                'valid' => false,
                'code' => 'INVALID_SIGNATURE',
                'message' => 'License digital signature is invalid or forged.',
                'license' => $license,
            ];
        }

        // 5. Expiration Check
        $now = Carbon::now();
        if ($now->greaterThan($license->valid_until)) {
            $license->update(['status' => 'expired']);
            $this->audit('license_expired', ['expired_at' => $license->valid_until->toIso8601String()]);

            return [
                'valid' => false,
                'code' => 'LICENSE_EXPIRED',
                'message' => 'License has expired on ' . $license->valid_until->format('Y-m-d H:i:s'),
                'license' => $license,
            ];
        }

        return [
            'valid' => true,
            'code' => 'ACTIVE',
            'message' => 'License is valid and active.',
            'license' => $license,
        ];
    }

    public function isModuleAllowed(string $moduleName): bool
    {
        $verification = $this->verify();
        if (!$verification['valid']) {
            return false;
        }

        /** @var SystemLicense $license */
        $license = $verification['license'];
        $allowed = $license->allowed_modules ?? [];

        if (in_array('*', $allowed, true) || in_array('ALL', $allowed, true)) {
            return true;
        }

        return in_array($moduleName, $allowed, true);
    }

    public function activateToken(string $token): SystemLicense
    {
        $parts = explode('.', trim($token));
        if (count($parts) !== 2) {
            throw new \InvalidArgumentException('Invalid license token format. Expected payload.signature');
        }

        $payloadJson = base64_decode($parts[0], true);
        $signature = base64_decode($parts[1], true);

        if (!$payloadJson || !$signature) {
            throw new \InvalidArgumentException('Failed to decode base64 license token.');
        }

        $payload = json_decode($payloadJson, true);
        if (!is_array($payload)) {
            throw new \InvalidArgumentException('Invalid JSON inside license payload.');
        }

        if (!$this->verifySignature($payloadJson, $signature)) {
            throw new \InvalidArgumentException('License signature is invalid. Token was rejected.');
        }

        $required = ['instance_id', 'client_name', 'client_code', 'license_key', 'hardware_id', 'valid_until', 'allowed_modules'];
        foreach ($required as $req) {
            if (!isset($payload[$req])) {
                throw new \InvalidArgumentException("Missing required payload field: {$req}");
            }
        }

        $hwid = $this->fingerprintService->getFingerprint();
        if (config('license.strict_hardware_binding', true)) {
            if (!$this->fingerprintService->matches($payload['hardware_id'])) {
                throw new \InvalidArgumentException("License is locked to a different machine ({$payload['hardware_id']}). Current: {$hwid}");
            }
        }

        SystemLicense::query()->where('status', 'active')->update(['status' => 'superseded']);

        $issuedAt = isset($payload['issued_at']) ? Carbon::parse($payload['issued_at']) : Carbon::now();
        $validUntil = Carbon::parse($payload['valid_until']);

        $license = new SystemLicense([
            'instance_id' => $payload['instance_id'],
            'client_name' => $payload['client_name'],
            'client_code' => $payload['client_code'],
            'license_key' => $payload['license_key'],
            'token_payload' => $payloadJson,
            'digital_signature' => base64_encode($signature),
            'hardware_id' => $payload['hardware_id'],
            'tier' => $payload['tier'] ?? 'standard',
            'issued_at' => $issuedAt,
            'valid_until' => $validUntil,
            'last_synced_at' => Carbon::now(),
            'max_users' => (int) ($payload['max_users'] ?? 0),
            'allowed_modules' => $payload['allowed_modules'],
            'status' => 'active',
        ]);

        $license->integrity_hash = $license->computeIntegrityHash($hwid);
        $license->save();

        $this->recordClockWatermark(Carbon::now()->timestamp);

        $this->audit('activated', [
            'client_code' => $license->client_code,
            'valid_until' => $license->valid_until->toIso8601String(),
            'modules_count' => count($license->allowed_modules),
        ]);

        return $license;
    }

    public function verifySignature(string $payload, string $signature): bool
    {
        $publicKey = $this->getPublicKey();
        if (!$publicKey) {
            Log::warning('No RSA Public Key configured for SystemLicenseGuard. Signature verification skipped in insecure mode.');
            return true;
        }

        $result = openssl_verify($payload, $signature, $publicKey, OPENSSL_ALGO_SHA256);
        return $result === 1;
    }

    public function getPublicKey(): ?string
    {
        $inlineKey = config('license.public_key');
        if ($inlineKey) {
            return $inlineKey;
        }

        $path = config('license.public_key_path');
        if ($path && file_exists($path)) {
            return file_get_contents($path);
        }

        return null;
    }

    protected function checkAndRecordClock(): bool
    {
        $currentTs = Carbon::now()->timestamp;

        $lastWatermark = SystemLicenseWatermark::query()->latest('id')->first();
        if ($lastWatermark) {
            if ($currentTs < ($lastWatermark->highest_seen_timestamp - 60)) {
                return false;
            }

            $expected = SystemLicenseWatermark::computeChecksum($lastWatermark->highest_seen_timestamp);
            if (!hash_equals($expected, $lastWatermark->checksum)) {
                return false;
            }

            if ($currentTs > $lastWatermark->highest_seen_timestamp) {
                $lastWatermark->update([
                    'highest_seen_timestamp' => $currentTs,
                    'recorded_at' => Carbon::now(),
                    'checksum' => SystemLicenseWatermark::computeChecksum($currentTs),
                ]);
            }
        } else {
            $this->recordClockWatermark($currentTs);
        }

        return true;
    }

    protected function recordClockWatermark(int $timestamp): void
    {
        SystemLicenseWatermark::create([
            'highest_seen_timestamp' => $timestamp,
            'recorded_at' => Carbon::now(),
            'checksum' => SystemLicenseWatermark::computeChecksum($timestamp),
        ]);
    }

    protected function audit(string $event, array $details = []): void
    {
        try {
            SystemLicenseAuditLog::create([
                'event_type' => $event,
                'details' => $details,
                'ip_address' => request()?->ip(),
                'user_agent' => request()?->userAgent(),
            ]);
        } catch (\Throwable) {}
    }
}
