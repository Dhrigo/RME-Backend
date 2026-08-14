<?php

namespace Modules\BpjsVClaim\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Modules\Auth\Models\User;
use Tests\TestCase;

class ReferensiControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_passes_through_diagnosa_lookup(): void
    {
        Http::fake([
            '*' => Http::response([
                'metaData' => ['code' => '200', 'message' => 'Ok'],
                'response' => [['kode' => 'A00.0', 'nama' => 'Cholera']],
            ]),
        ]);

        $this->actingUser();

        $response = $this->getJson('/api/v1/referensi/diagnosa/cholera');

        $response->assertOk()->assertJsonPath('metaData.code', '200');
        Http::assertSent(fn ($request) => str_contains($request->url(), 'referensi/diagnosa/cholera'));
    }

    public function test_it_does_not_persist_reference_data(): void
    {
        Http::fake(['*' => Http::response(['metaData' => ['code' => '200'], 'response' => []])]);
        $this->actingUser();

        $this->getJson('/api/v1/referensi/propinsi')->assertOk();

        $this->assertDatabaseCount('seps', 0);
    }

    public function test_guest_cannot_access_referensi(): void
    {
        $this->getJson('/api/v1/referensi/propinsi')->assertStatus(401);
    }
}
