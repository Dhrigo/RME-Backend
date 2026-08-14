<?php

namespace Modules\SystemLicenseGuard\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\SystemLicenseGuard\Services\LicenseVerifierService;
use Symfony\Component\HttpFoundation\Response;

class CheckModuleAccessMiddleware
{
    public function __construct(
        protected LicenseVerifierService $verifier
    ) {}

    public function handle(Request $request, Closure $next, string $moduleName): Response
    {
        if (!$this->verifier->isModuleAllowed($moduleName)) {
            return response()->json([
                'success' => false,
                'error_code' => 'MODULE_NOT_SUBSCRIBED',
                'message' => "Module '{$moduleName}' is not enabled in your current SaaS subscription plan.",
                'module' => $moduleName,
            ], Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
