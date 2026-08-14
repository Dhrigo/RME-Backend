<?php

namespace Modules\SystemLicenseGuard\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\SystemLicenseGuard\Http\Requests\ActivateLicenseRequest;
use Modules\SystemLicenseGuard\Http\Requests\SyncLicenseRequest;
use Modules\SystemLicenseGuard\Http\Resources\LicenseStatusResource;
use Modules\SystemLicenseGuard\Services\CentralHubClientService;
use Modules\SystemLicenseGuard\Services\HardwareFingerprintService;
use Modules\SystemLicenseGuard\Services\LicenseVerifierService;

class LicenseController extends Controller
{
    public function __construct(
        protected LicenseVerifierService $verifier,
        protected HardwareFingerprintService $fingerprintService,
        protected CentralHubClientService $hubClient
    ) {}

    public function status(): JsonResponse
    {
        $verification = $this->verifier->verify();
        $license = $verification['license'] ?? $this->verifier->getActiveLicense();

        return response()->json([
            'success' => $verification['valid'],
            'verification_code' => $verification['code'],
            'message' => $verification['message'],
            'fingerprint' => $this->fingerprintService->getFingerprint(),
            'data' => new LicenseStatusResource($license),
        ]);
    }

    public function fingerprint(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'fingerprint' => $this->fingerprintService->getFingerprint(),
            'hostname' => gethostname(),
            'php_version' => PHP_VERSION,
            'os' => PHP_OS_FAMILY,
        ]);
    }

    public function activate(ActivateLicenseRequest $request): JsonResponse
    {
        if ($request->filled('license_token')) {
            try {
                $license = $this->verifier->activateToken($request->input('license_token'));

                return response()->json([
                    'success' => true,
                    'message' => 'License activated successfully via cryptographic token.',
                    'data' => new LicenseStatusResource($license),
                ]);
            } catch (\Throwable $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Activation failed: ' . $e->getMessage(),
                ], 422);
            }
        }

        $result = $this->hubClient->activateOnline(
            $request->input('license_key'),
            $request->input('central_hub_url')
        );

        if (!$result['success']) {
            return response()->json([
                'success' => false,
                'message' => $result['message'],
            ], 422);
        }

        return response()->json([
            'success' => true,
            'message' => $result['message'],
            'data' => new LicenseStatusResource($result['license']),
        ]);
    }

    public function sync(SyncLicenseRequest $request): JsonResponse
    {
        $result = $this->hubClient->sendHeartbeat();

        return response()->json([
            'success' => $result['success'],
            'message' => $result['message'],
            'verification' => $this->verifier->verify(),
        ], $result['success'] ? 200 : 502);
    }

    public function webhook(Request $request): JsonResponse
    {
        $secret = config('license.webhook_secret');
        if (!empty($secret)) {
            $signature = $request->header('X-Hub-Signature-256');
            $expected = 'sha256=' . hash_hmac('sha256', $request->getContent(), $secret);

            if (!hash_equals($expected, (string) $signature)) {
                return response()->json(['success' => false, 'message' => 'Invalid webhook signature.'], 403);
            }
        }

        $event = $request->input('event');
        $token = $request->input('token');

        if ($event === 'license.updated' && $token) {
            try {
                $license = $this->verifier->activateToken($token);
                return response()->json([
                    'success' => true,
                    'message' => 'License updated from central hub webhook.',
                    'data' => new LicenseStatusResource($license),
                ]);
            } catch (\Throwable $e) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
            }
        }

        if ($event === 'license.suspended') {
            $license = $this->verifier->getActiveLicense();
            if ($license) {
                $license->update(['status' => 'suspended']);
            }
            return response()->json(['success' => true, 'message' => 'Instance suspended.']);
        }

        return response()->json(['success' => true, 'message' => 'Event received.']);
    }
}
