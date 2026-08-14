<?php

namespace Modules\SystemLicenseGuard\tests\Feature;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Modules\SystemLicenseGuard\Models\SystemLicense;
use Modules\SystemLicenseGuard\Services\HardwareFingerprintService;
use Tests\TestCase;

class SystemLicenseGuardTest extends TestCase
{
    use RefreshDatabase;

    protected string $privateKey = <<<EOD
-----BEGIN PRIVATE KEY-----
MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQCml7jXqi271Bd7
8HTIEsNZon3VDIp9xFp0H2D7LS9YTg9wgiTshO5zjwXPdYPXAY5gnK3v5762CoWt
8xQfrPjlXn/tKLfmrdz0SjX9a3TJ2sY3sU3m0CZ8pZshmxbzb+vJIvv6wLzFHRMZ
9Qtv2csVrJh5LR2B0s0e3YwmGTCxPkKPd0Xubebl9eK7IzungSUeQrQ8nTgkH2vz
B7IY+NQsnAKJ/f7P5X3tfu5QB2kL16yvQ3t3jO0zyKE5p2oReCqMB+iwBdiK4o4o
KPL+f8RuniVQZ6KYBzpE5k9H9lMuOforPGp2LgejdHhwydZFfVHSgxK9K3LlQRaR
x1oSSA1vAgMBAAECggEAFTDqjeBzZdeiTx00tbiRSeceC4pHWZ0vBmNxcjH6ukhf
tWeQq9dy/5cbXZrstN5ZTpfPlltLyptHCuwHTMozdPXS3weVcQ3/s8F24bAYEI84
NKBksO4cXzGvrJQuVLQRcan2FJ0MxiQfKGef11AEgdLNKGjhPoDin8D90WDV7U2y
HVDmSgI3FQb2h1csWFW/fcq0UWhRtjGXsQ05XruGJBVwGu2IXlY8X8VRUDujjNqc
bMXRwevOwlMSsNDt9xGd+5qJ3TLkbo7MYe035Xj4waw1L3uSXknNyuYq5LouZsD9
TIZABs2+1KjTKBTQzWBRXYUwy5kQdkfX1TSlK7xJjQKBgQDRoXN3BxwefbviA4eB
FZxQXddalz8QgM+QPUUOCrCR6hjCM3apSn3jcdEetdzrOao1BRQyiFTrK/dErWgw
OXl0RJ1vPiRut1rIGopnj+iaETHToH4smjvzFnjrGs3NXrf3JFROVWpdO4JB6BMY
wWVxSgQbpuyfU05SLVHJE8KoGwKBgQDLcTNPjxgj+NC7oSeB5b1342+pTMkP7kL6
yEueJVEXYz7P33Puwnr5U1pfsxJoT17abST3SfmqG8iMOdZk+T/jjTcdnqFKViA2
LYG+5K71GM5zsNc1ma361Y8CCSp0ECrn8RotoU0Q4fX+7JQDQ5oiaFPHkn7h1sGd
b/m9JB/tPQKBgBsPiGQ5Grwk5vgKFJfpPkBxnLcpBw8OUb0A68UgRCLR4VhQZGT+
JLoTmzcnqtkCnKIzgaP0TWH+TvEioWx4PuFvahNOJk3UhXeHVY6A2TnqNlBnS2Je
lpaOtBVFZIO6Um0o12k1RYG7iNkRKEXt0TaKo3UeWzVF/7pD92bJkjs5AoGBAMNf
BbCcsckx1Hqry74CPA8bOotycxA6dtZRbdUE7zgvlg2ZAMPEvsYbVwnadY340xWe
hUZ6IypKnjCUBqFXgBRt9AUc5rX1ud9tmlERWjeESBdwN2yBFkRxvHFvDfcB48J0
lvhFFDZnWY8j8Qylaisq13Ir7G/DhpJEC6ipPYPdAoGBAMDaQkYgfPbPtOM2Ht/D
aDAzjerIOPegHWugIXzDWyXuW7cIiPCeUXmNesTCqBJSsU1++KTBNHQsejhh0LwT
fTxRvFiK4AvuRf77Kz4VEcHGzEBiURYY+7iNtpH/jCOHQ1g38E/uk8fX8bBG+yW4
9HYwMDF1/gfLC9AUzcWL/WRT
-----END PRIVATE KEY-----
EOD;

    protected string $publicKey = <<<EOD
-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAppe416otu9QXe/B0yBLD
WaJ91QyKfcRadB9g+y0vWE4PcIIk7ITuc48Fz3WD1wGOYJyt7+e+tgqFrfMUH6z4
5V5/7Si35q3c9Eo1/Wt0ydrGN7FN5tAmfKWbIZsW82/rySL7+sC8xR0TGfULb9nL
FayYeS0dgdLNHt2MJhkwsT5Cj3dF7m3m5fXiuyM7p4ElHkK0PJ04JB9r8weyGPjU
LJwCif3+z+V97X7uUAdpC9esr0N7d4ztM8ihOadqEXgqjAfosAXYiuKOKCjy/n/E
bp4lUGeimAc6ROZPR/ZTLjn6Kzxqdi4Ho3R4cMnWRX1R0oMSvSty5UEWkcdaEkgN
bwIDAQAB
-----END PUBLIC KEY-----
EOD;

    protected string $hwid;

    protected function setUp(): void
    {
        parent::setUp();

        config(['license.public_key' => $this->publicKey]);
        config(['license.strict_hardware_binding' => true]);
        config(['license.enable_clock_tamper_detection' => true]);

        $this->hwid = app(HardwareFingerprintService::class)->getFingerprint();

        // Register dummy test routes protected by middleware
        Route::middleware(['api', 'license.check'])->prefix('api/test')->group(function () {
            Route::get('/protected-general', fn() => response()->json(['success' => true, 'msg' => 'general ok']));
            Route::middleware('module.access:SatuSehatIgd')->get('/protected-satusehat', fn() => response()->json(['success' => true, 'msg' => 'satusehat ok']));
            Route::middleware('module.access:KamarOperasi')->get('/protected-ok', fn() => response()->json(['success' => true, 'msg' => 'ok ok']));
        });
    }

    /**
     * Helper to generate signed license token
     */
    protected function generateSignedToken(array $override = []): string
    {
        $payload = array_merge([
            'instance_id' => 'INST-' . uniqid(),
            'client_name' => 'RS Harapan Sehat',
            'client_code' => 'RSHS-001',
            'license_key' => 'LIC-' . strtoupper(bin2hex(random_bytes(8))),
            'hardware_id' => $this->hwid,
            'tier' => 'enterprise',
            'issued_at' => Carbon::now()->toIso8601String(),
            'valid_until' => Carbon::now()->addYear()->toIso8601String(),
            'max_users' => 100,
            'allowed_modules' => ['SatuSehatIgd', 'LayananPrescription', 'MedicalRecordAnamnesis'],
        ], $override);

        $payloadJson = json_encode($payload);
        openssl_sign($payloadJson, $signature, $this->privateKey, OPENSSL_ALGO_SHA256);

        return base64_encode($payloadJson) . '.' . base64_encode($signature);
    }

    public function test_it_returns_hardware_fingerprint(): void
    {
        $response = $this->getJson('/api/v1/system/license/fingerprint');

        $response->assertOk()
            ->assertJsonPath('success', true)
            ->assertJsonStructure(['fingerprint', 'hostname', 'os']);
        
        $this->assertStringStartsWith('HWID-', $response->json('fingerprint'));
    }

    public function test_it_reports_unlicensed_when_no_license_installed(): void
    {
        $response = $this->getJson('/api/v1/system/license/status');

        $response->assertOk()
            ->assertJsonPath('success', false)
            ->assertJsonPath('verification_code', 'NO_LICENSE')
            ->assertJsonPath('data.has_license', false);
    }

    public function test_it_activates_with_valid_cryptographic_token(): void
    {
        $token = $this->generateSignedToken();

        $response = $this->postJson('/api/v1/system/license/activate', [
            'license_token' => $token,
        ]);

        $response->assertOk()
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.client_code', 'RSHS-001')
            ->assertJsonPath('data.tier', 'enterprise')
            ->assertJsonPath('data.status', 'active');

        $this->assertDatabaseHas('system_licenses', [
            'client_code' => 'RSHS-001',
            'status' => 'active',
        ]);
    }

    public function test_it_rejects_forged_or_tampered_token_signature(): void
    {
        $token = $this->generateSignedToken();
        // Tamper with payload
        $parts = explode('.', $token);
        $payload = json_decode(base64_decode($parts[0]), true);
        $payload['valid_until'] = Carbon::now()->addYears(10)->toIso8601String(); // Hacker extended expiry
        $forgedToken = base64_encode(json_encode($payload)) . '.' . $parts[1]; // Old signature doesn't match!

        $response = $this->postJson('/api/v1/system/license/activate', [
            'license_token' => $forgedToken,
        ]);

        $response->assertStatus(422)
            ->assertJsonPath('success', false);

        $this->assertDatabaseMissing('system_licenses', [
            'client_code' => 'RSHS-001',
        ]);
    }

    public function test_it_rejects_token_locked_to_different_hardware(): void
    {
        $token = $this->generateSignedToken([
            'hardware_id' => 'HWID-DEAD-BEEF-0000-1111', // Other machine
        ]);

        $response = $this->postJson('/api/v1/system/license/activate', [
            'license_token' => $token,
        ]);

        $response->assertStatus(422)
            ->assertJsonPath('success', false);
    }

    public function test_it_detects_local_database_record_tampering(): void
    {
        // 1. Activate valid license
        $token = $this->generateSignedToken();
        $this->postJson('/api/v1/system/license/activate', ['license_token' => $token]);

        // 2. Direct SQL modification by rogue DBA
        $license = SystemLicense::query()->first();
        $license->update(['valid_until' => Carbon::now()->addYears(20)]); // Modified directly without HMAC update

        // 3. Status check must catch DB tampering
        $response = $this->getJson('/api/v1/system/license/status');

        $response->assertOk()
            ->assertJsonPath('success', false)
            ->assertJsonPath('verification_code', 'DB_TAMPERED');
    }

    public function test_it_blocks_general_requests_when_unlicensed_or_expired(): void
    {
        // Unlicensed request
        $response = $this->getJson('/api/test/protected-general');
        $response->assertStatus(402)
            ->assertJsonPath('error_code', 'NO_LICENSE');

        // Expired license
        $token = $this->generateSignedToken([
            'valid_until' => Carbon::now()->subDay()->toIso8601String(),
        ]);
        $this->postJson('/api/v1/system/license/activate', ['license_token' => $token]);

        $response2 = $this->getJson('/api/test/protected-general');
        $response2->assertStatus(402)
            ->assertJsonPath('error_code', 'LICENSE_EXPIRED');
    }

    public function test_it_enforces_module_feature_gates(): void
    {
        $token = $this->generateSignedToken([
            'allowed_modules' => ['SatuSehatIgd'], // KamarOperasi is not allowed
        ]);
        $this->postJson('/api/v1/system/license/activate', ['license_token' => $token]);

        // General route is allowed
        $this->getJson('/api/test/protected-general')->assertOk();

        // Allowed module route is allowed
        $this->getJson('/api/test/protected-satusehat')->assertOk();

        // Disallowed module route is blocked with 403
        $response = $this->getJson('/api/test/protected-ok');
        $response->assertStatus(403)
            ->assertJsonPath('error_code', 'MODULE_NOT_SUBSCRIBED')
            ->assertJsonPath('module', 'KamarOperasi');
    }
}
