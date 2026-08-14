<?php

namespace Modules\BpjsAntreanFktp\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Modules\Auth\Models\User;
use Modules\BpjsAntreanFktp\Models\Antrean;
use Tests\TestCase;

class AntreanControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    private function payload(): array
    {
        return [
            'jenispasien' => 'JKN',
            'nomorkartu' => '0001234567890',
            'nik' => '3212345678987654',
            'nohp' => '085635228888',
            'kodepoli' => 'ANA',
            'namapoli' => 'Anak',
            'pasienbaru' => 0,
            'norm' => '123345',
            'tanggalperiksa' => now()->toDateString(),
            'kodedokter' => 12345,
            'namadokter' => 'Dr. Hendra',
            'jampraktek' => '08:00-16:00',
            'jeniskunjungan' => 1,
            'nomorreferensi' => '0001R0040116A000001',
            'nomorantrean' => 'A-12',
            'angkaantrean' => 12,
            'estimasidilayani' => now()->addHour()->toDateTimeString(),
            'sisakuotajkn' => 5,
            'kuotajkn' => 30,
            'sisakuotanonjkn' => 5,
            'kuotanonjkn' => 30,
            'keterangan' => 'Peserta harap 30 menit lebih awal.',
        ];
    }

    public function test_it_submits_antrean_and_stores_bpjs_result_on_success(): void
    {
        $this->actingUser();

        Http::fake([
            '*/antrean/add' => Http::response(['metaData' => ['code' => '200', 'message' => 'Ok'], 'response' => null]),
        ]);

        $response = $this->postJson('/api/v1/antrean-fktp/antrean', $this->payload());

        $response->assertCreated()->assertJsonPath('data.status', 'success');
        $this->assertDatabaseHas('antrean_fktp_antreans', ['kodepoli' => 'ANA', 'status' => 'success', 'bpjs_sync_status' => 'synced']);

        Http::assertSent(fn ($request) => str_contains($request->url(), 'antrean/add'));
    }

    public function test_it_stores_failure_when_bpjs_rejects_antrean(): void
    {
        $this->actingUser();

        Http::fake([
            '*/antrean/add' => Http::response(['metaData' => ['code' => '201', 'message' => 'Dokter tidak ditemukan'], 'response' => null]),
        ]);

        $response = $this->postJson('/api/v1/antrean-fktp/antrean', $this->payload());

        $response->assertCreated()->assertJsonPath('data.status', 'failed');
        $this->assertDatabaseHas('antrean_fktp_antreans', ['status' => 'failed', 'bpjs_sync_status' => 'failed']);
    }

    public function test_it_cancels_antrean_when_bpjs_confirms(): void
    {
        $this->actingUser();
        $antrean = Antrean::factory()->create(['status' => 'success', 'bpjs_sync_status' => 'synced']);

        Http::fake([
            '*/antrean/batal' => Http::response(['metaData' => ['code' => '200', 'message' => 'Ok'], 'response' => null]),
        ]);

        $response = $this->postJson("/api/v1/antrean-fktp/antrean/{$antrean->id}/batal", [
            'keterangan' => 'Perubahan jadwal dokter',
        ]);

        $response->assertOk()->assertJsonPath('data.status', 'batal');
        $this->assertDatabaseHas('antrean_fktp_antreans', ['id' => $antrean->id, 'status' => 'batal']);
    }

    public function test_guest_cannot_access_antrean(): void
    {
        $this->getJson('/api/v1/antrean-fktp/antrean')->assertStatus(401);
    }
}
