<?php

namespace Modules\BpjsPCare\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Modules\Auth\Models\User;
use Modules\BpjsPCare\Models\Kunjungan;
use Tests\TestCase;

class KunjunganControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_kunjungan_and_stores_bpjs_visit_number(): void
    {
        $this->actingUser();

        Http::fake([
            '*/pcare-rest-dev/kunjungan' => Http::response([
                'metaData' => ['code' => '200', 'message' => 'OK'],
                'response' => ['noKunjungan' => 'KJ0001'],
            ], 200),
        ]);

        $response = $this->postJson('/api/v1/kunjungans', [
            'no_kartu' => '0001234567890',
            'tanggal_kunjungan' => '2026-08-14',
            'kode_poli' => '01',
        ]);

        $response->assertCreated()->assertJsonPath('data.nomor_kunjungan', 'KJ0001');
        $this->assertDatabaseHas('kunjungans', ['no_kartu' => '0001234567890', 'nomor_kunjungan' => 'KJ0001']);
    }

    public function test_it_updates_kunjungan_and_records_new_bpjs_response(): void
    {
        $this->actingUser();
        $kunjungan = Kunjungan::factory()->create(['nomor_kunjungan' => 'KJ0002']);

        Http::fake([
            '*' => Http::response(['metaData' => ['code' => '200', 'message' => 'OK'], 'response' => ['noKunjungan' => 'KJ0002']], 200),
        ]);

        $response = $this->putJson("/api/v1/kunjungans/{$kunjungan->id}", [
            'kode_status_pulang' => '1',
        ]);

        $response->assertOk()->assertJsonPath('data.kode_status_pulang', '1');
        $this->assertDatabaseHas('kunjungans', ['id' => $kunjungan->id, 'kode_status_pulang' => '1']);
    }

    public function test_riwayat_kunjungan_is_a_live_passthrough_not_local_lookup(): void
    {
        $this->actingUser();

        Http::fake([
            '*' => Http::response([
                'metaData' => ['code' => '200', 'message' => 'OK'],
                'response' => ['riwayat' => [['noKunjungan' => 'KJ9000']]],
            ], 200),
        ]);

        $response = $this->getJson('/api/v1/kunjungans/riwayat?noKartu=0001234567890');

        $response->assertOk()->assertJsonPath('response.riwayat.0.noKunjungan', 'KJ9000');
        Http::assertSent(fn ($request) => str_contains($request->url(), 'kunjungan/riwayat'));
    }
}
