<?php

namespace Modules\SystemLicenseGuard\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\SystemLicenseGuard\Services\HardwareFingerprintService;
use Modules\SystemLicenseGuard\Services\LicenseVerifierService;
use Symfony\Component\HttpFoundation\Response;

class CheckLicenseMiddleware
{
    public function __construct(
        protected LicenseVerifierService $verifier
    ) {}

    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('api/v1/system/license*')) {
            return $next($request);
        }

        $result = $this->verifier->verify();

        if (!$result['valid']) {
            return response()->json([
                'success' => false,
                'error_code' => $result['code'],
                'message' => $result['message'],
                'instance_fingerprint' => app(HardwareFingerprintService::class)->getFingerprint(),
            ], Response::HTTP_PAYMENT_REQUIRED);
        }

        return $next($request);
    }
}
