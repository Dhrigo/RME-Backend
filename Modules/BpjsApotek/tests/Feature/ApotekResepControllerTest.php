<?php

namespace Modules\BpjsApotek\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Modules\Auth\Models\User;
use Modules\BpjsApotek\Models\ApotekResep;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

class ApotekResepControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_submits_a_resep_and_stores_bpjs_result_on_success(): void
    {
        $this->actingUser();
        $visit = Visit::factory()->create();

        Http::fake([
            '*/resep/insert' => Http::response([
                'metaData' => ['code' => '200', 'message' => 'OK'],
                'response' => ['noResep' => 'RSP0001'],
            ]),
        ]);

        $response = $this->postJson('/api/v1/apotek/resep', [
            'visit_id' => $visit->id,
            'no_sep' => '0301R0010119V000001',
            'no_kartu' => '0001234567890',
            'tanggal_resep' => now()->toDateString(),
            'poli_kode' => 'INT',
        ]);

        $response->assertCreated()->assertJsonPath('data.status', 'success')->assertJsonPath('data.bpjs_no_resep', 'RSP0001');
        $this->assertDatabaseHas('apotek_reseps', ['visit_id' => $visit->id, 'status' => 'success', 'bpjs_no_resep' => 'RSP0001']);
    }

    public function test_it_stores_failure_when_bpjs_rejects_the_resep(): void
    {
        $this->actingUser();
        $visit = Visit::factory()->create();

        Http::fake([
            '*/resep/insert' => Http::response([
                'metaData' => ['code' => '201', 'message' => 'No SEP tidak ditemukan'],
                'response' => null,
            ]),
        ]);

        $response = $this->postJson('/api/v1/apotek/resep', [
            'visit_id' => $visit->id,
            'no_sep' => '0301R0010119V000002',
            'no_kartu' => '0001234567891',
            'tanggal_resep' => now()->toDateString(),
        ]);

        $response->assertCreated()->assertJsonPath('data.status', 'failed');
        $this->assertDatabaseHas('apotek_reseps', ['status' => 'failed', 'bpjs_no_resep' => null]);
    }

    public function test_it_deletes_a_resep_when_bpjs_confirms(): void
    {
        $this->actingUser();
        $resep = ApotekResep::factory()->create(['bpjs_no_resep' => 'RSP0002', 'status' => 'success']);

        Http::fake([
            '*/resep/delete/*' => Http::response(['metaData' => ['code' => '200', 'message' => 'OK'], 'response' => null]),
        ]);

        $this->deleteJson("/api/v1/apotek/resep/{$resep->id}")->assertNoContent();
        $this->assertDatabaseMissing('apotek_reseps', ['id' => $resep->id]);
    }

    public function test_guest_cannot_access_resep(): void
    {
        $this->getJson('/api/v1/apotek/resep')->assertStatus(401);
    }
}
