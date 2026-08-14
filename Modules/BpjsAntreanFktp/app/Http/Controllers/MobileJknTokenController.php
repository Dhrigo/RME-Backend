<?php

namespace Modules\BpjsAntreanFktp\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\BpjsAntreanFktp\Models\MobileJknToken;

/**
 * Token endpoint (confirmed spec): Mobile JKN calls this with
 * x-username/x-password (credentials BPJS issued to THIS hospital,
 * config('bpjs.families.antrean_fktp.inbound_username'/'inbound_password')),
 * we validate and issue a token it then sends as x-token on every
 * subsequent inbound call.
 */
class MobileJknTokenController extends Controller
{
    public function index(Request $request)
    {
        $username = $request->header('x-username');
        $password = $request->header('x-password');

        $config = config('bpjs.families.antrean_fktp');

        if (! $username || ! $password || $username !== $config['inbound_username'] || $password !== $config['inbound_password']) {
            return response()->json(['metadata' => ['message' => 'Invalid credentials', 'code' => 401]], 401);
        }

        $token = MobileJknToken::create([
            'username' => $username,
            'token' => Str::random(40),
            'expires_at' => now()->addHours(12),
        ]);

        return response()->json([
            'response' => ['token' => $token->token],
            'metadata' => ['message' => 'Ok', 'code' => 200],
        ]);
    }
}
