<?php

namespace Modules\BpjsICare\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Modules\Auth\Models\User;
use Tests\TestCase;

class RiwayatPelayananControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_calls_the_icare_validate_endpoint_and_returns_the_response(): void
    {
        Http::fake([
            '*api/rs/validate' => Http::response([
                'metaData' => ['code' => '200', 'message' => 'OK'],
                'response' => ['nama' => 'TRI M', 'riwayat' => []],
            ]),
        ]);

        $this->actingUser();

        $response = $this->postJson('/api/v1/riwayat-pelayanan/validate', [
            'param' => '2200009338321',
            'kodedokter' => 11111,
        ]);

        $response->assertOk();
        $this->assertSame('TRI M', $response->json('response.nama'));

        Http::assertSent(function ($request) {
            return str_contains($request->url(), 'api/rs/validate')
                && $request->method() === 'POST'
                && $request['param'] === '2200009338321'
                && $request['kodedokter'] === 11111;
        });
    }

    public function test_it_requires_param_and_kodedokter(): void
    {
        $this->actingUser();

        $response = $this->postJson('/api/v1/riwayat-pelayanan/validate', []);

        $response->assertStatus(422)->assertJsonValidationErrors(['param', 'kodedokter']);
    }

    public function test_guest_cannot_access_riwayat_pelayanan(): void
    {
        $this->postJson('/api/v1/riwayat-pelayanan/validate', [
            'param' => '2200009338321',
            'kodedokter' => 11111,
        ])->assertStatus(401);
    }
}
