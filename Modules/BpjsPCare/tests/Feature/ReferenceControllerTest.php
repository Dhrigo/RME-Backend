<?php

namespace Modules\BpjsPCare\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Modules\Auth\Models\User;
use Tests\TestCase;

class ReferenceControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_diagnosa_lookup_is_a_pure_passthrough(): void
    {
        $this->actingUser();

        Http::fake([
            '*' => Http::response([
                'metaData' => ['code' => '200', 'message' => 'OK'],
                'response' => [['kode' => 'A00', 'nama' => 'Kolera']],
            ], 200),
        ]);

        $response = $this->getJson('/api/v1/pcare-ref/diagnosa?keyword=kolera');

        $response->assertOk()->assertJsonPath('response.0.kode', 'A00');
        Http::assertSent(fn ($request) => str_contains($request->url(), 'referensi/diagnosa'));
        $this->assertDatabaseCount('kunjungans', 0);
    }

    public function test_peserta_lookup_does_not_persist_anything(): void
    {
        $this->actingUser();

        Http::fake([
            '*' => Http::response([
                'metaData' => ['code' => '200', 'message' => 'OK'],
                'response' => ['nama' => 'TRI M', 'noKartu' => '0001234567890'],
            ], 200),
        ]);

        $response = $this->getJson('/api/v1/pcare-ref/peserta?noKartu=0001234567890');

        $response->assertOk()->assertJsonPath('response.nama', 'TRI M');
    }

    public function test_guest_cannot_access_reference_lookups(): void
    {
        $this->getJson('/api/v1/pcare-ref/diagnosa')->assertStatus(401);
    }
}
