<?php

namespace Modules\BpjsAntreanRs\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Modules\BpjsAntreanRs\Models\MobileJknToken;
use Tests\TestCase;

class MobileJknAntreanControllerTest extends TestCase
{
    use RefreshDatabase;

    private function issueToken(): MobileJknToken
    {
        return MobileJknToken::create([
            'username' => 'mobilejkn',
            'token' => 'test-token-123',
            'expires_at' => now()->addHours(12),
        ]);
    }

    public function test_token_endpoint_issues_token_for_valid_credentials(): void
    {
        config(['bpjs.families.antrean_rs.inbound_username' => 'rsuser', 'bpjs.families.antrean_rs.inbound_password' => 'rspass']);

        $response = $this->withHeaders(['x-username' => 'rsuser', 'x-password' => 'rspass'])
            ->getJson('/api/v1/antrean-rs/mobile-jkn/token');

        $response->assertOk()->assertJsonPath('metadata.code', 200);
        $this->assertNotEmpty($response->json('response.token'));
        $this->assertDatabaseHas('antrean_rs_mobile_jkn_tokens', ['username' => 'rsuser']);
    }

    public function test_token_endpoint_rejects_invalid_credentials(): void
    {
        config(['bpjs.families.antrean_rs.inbound_username' => 'rsuser', 'bpjs.families.antrean_rs.inbound_password' => 'rspass']);

        $this->withHeaders(['x-username' => 'rsuser', 'x-password' => 'wrong'])
            ->getJson('/api/v1/antrean-rs/mobile-jkn/token')
            ->assertStatus(401);
    }

    public function test_ambil_antrean_requires_valid_token(): void
    {
        $this->postJson('/api/v1/antrean-rs/mobile-jkn/antrean', [
            'kodepoli' => 'ANA',
            'tanggalperiksa' => now()->toDateString(),
            'kodedokter' => 12345,
            'jampraktek' => '08:00-16:00',
            'jeniskunjungan' => 1,
        ])->assertStatus(401);
    }

    public function test_ambil_antrean_creates_local_booking_and_registers_with_bpjs(): void
    {
        $token = $this->issueToken();

        Http::fake([
            '*/antrean/add' => Http::response(['metaData' => ['code' => '200', 'message' => 'Ok'], 'response' => null]),
        ]);

        $response = $this->withHeaders(['x-username' => $token->username, 'x-token' => $token->token])
            ->postJson('/api/v1/antrean-rs/mobile-jkn/antrean', [
                'nomorkartu' => '0001234567890',
                'nik' => '3212345678987654',
                'nohp' => '085635228888',
                'kodepoli' => 'ANA',
                'norm' => '123345',
                'tanggalperiksa' => now()->toDateString(),
                'kodedokter' => 12345,
                'jampraktek' => '08:00-16:00',
                'jeniskunjungan' => 1,
                'nomorreferensi' => '0001R0040116A000001',
            ]);

        $response->assertCreated()->assertJsonPath('metadata.code', 200);
        $this->assertNotEmpty($response->json('response.kodebooking'));
        $this->assertDatabaseHas('antrean_rs_antreans', ['kodepoli' => 'ANA', 'bpjs_sync_status' => 'synced']);
        Http::assertSent(fn ($request) => str_contains($request->url(), 'antrean/add'));
    }
}
