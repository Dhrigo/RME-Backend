<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Modules\Auth\Http\Requests\LoginRequest;
use Modules\Auth\Http\Resources\UserResource;
use Modules\Auth\Models\User;

class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        $login = $request->string('login')->toString();
        $throttleKey = strtolower($login).'|'.$request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            throw ValidationException::withMessages([
                'login' => "Terlalu banyak percobaan login. Coba lagi dalam {$this->secondsUntilAvailable($throttleKey)} detik.",
            ]);
        }

        $user = User::where('username', $login)->orWhere('email', $login)->first();

        if (! $user || ! Hash::check($request->string('password'), $user->password)) {
            RateLimiter::hit($throttleKey, 60);

            throw ValidationException::withMessages([
                'login' => 'Login atau password salah.',
            ]);
        }

        if ($user->is_locked) {
            throw ValidationException::withMessages([
                'login' => 'Akun ini dikunci.',
            ]);
        }

        if (! $user->is_active) {
            throw ValidationException::withMessages([
                'login' => 'Akun ini tidak aktif.',
            ]);
        }

        if ($user->active_until && $user->active_until->isPast()) {
            throw ValidationException::withMessages([
                'login' => 'Masa aktif akun ini sudah berakhir.',
            ]);
        }

        RateLimiter::clear($throttleKey);

        $token = $user->createToken($request->string('device_name')->toString());

        return response()->json([
            'user' => new UserResource($user),
            'token' => $token->plainTextToken,
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout berhasil.']);
    }

    public function logoutAll(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Semua sesi berhasil di-logout.']);
    }

    public function me(Request $request): UserResource
    {
        return new UserResource($request->user());
    }

    private function secondsUntilAvailable(string $key): int
    {
        return RateLimiter::availableIn($key);
    }
}
