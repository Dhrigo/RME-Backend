<?php

namespace Modules\BpjsAntreanRs\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\BpjsAntreanRs\Models\MobileJknToken;

/**
 * Guards inbound WS RS routes called by BPJS's Mobile JKN app. Mobile JKN's
 * own auth scheme (x-token/x-username, issued by the Token endpoint) is
 * separate from this app's auth:sanctum and from BpjsSignature (which only
 * signs OUTBOUND calls this hospital makes to BPJS).
 */
class VerifyBpjsMobileJknToken
{
    public function handle(Request $request, Closure $next)
    {
        $username = $request->header('x-username');
        $token = $request->header('x-token');

        if (! $username || ! $token) {
            return response()->json(['metadata' => ['message' => 'x-username/x-token required', 'code' => 401]], 401);
        }

        $record = MobileJknToken::where('username', $username)->where('token', $token)->first();

        if (! $record || $record->isExpired()) {
            return response()->json(['metadata' => ['message' => 'Invalid or expired token', 'code' => 401]], 401);
        }

        return $next($request);
    }
}
