<?php

namespace Modules\BpjsPCare\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Modules\Auth\Models\User;
use Modules\BpjsPCare\Models\Pendaftaran;
use Tests\TestCase;

class PendaftaranControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_pendaftaran_and_persists_bpjs_identifier_on_success(): void
    {
        $this->actingUser();

        Http::fake([
            '*/pcare-rest-dev/pendaftaran' => Http::response([
                'metaData' => ['code' => '200', 'message' => 'OK'],
                'response' => ['noPendaftaran' => 'PDF0001'],
            ], 200),
        ]);

        $response = $this->postJson('/api/v1/pendaftarans', [
            'nomor_urut' => 5,
            'tanggal_daftar' => '2026-08-14',
            'no_kartu' => '0001234567890',
            'nama_pasien' => 'Budi Santoso',
            'poli_tujuan' => '01',
        ]);

        $response->assertCreated()
            ->assertJsonPath('data.bpjs_no_pendaftaran', 'PDF0001')
            ->assertJsonPath('data.bpjs_error', null)
            ->assertJsonPath('data.status', 'menunggu');

        $this->assertDatabaseHas('pendaftarans', [
            'no_kartu' => '0001234567890',
            'bpjs_no_pendaftaran' => 'PDF0001',
        ]);

        Http::assertSent(fn ($request) => str_contains($request->url(), 'pendaftaran') && $request->method() === 'POST');
    }

    public function test_it_stores_bpjs_error_when_registration_fails(): void
    {
        $this->actingUser();

        Http::fake([
            '*/pcare-rest-dev/pendaftaran' => Http::response([
                'metaData' => ['code' => '201', 'message' => 'Nomor kartu tidak ditemukan'],
                'response' => null,
            ], 200),
        ]);

        $response = $this->postJson('/api/v1/pendaftarans', [
            'nomor_urut' => 6,
            'tanggal_daftar' => '2026-08-14',
            'no_kartu' => '9999999999999',
            'nama_pasien' => 'Siti Aminah',
            'poli_tujuan' => '02',
        ]);

        $response->assertCreated()
            ->assertJsonPath('data.bpjs_error', 'Nomor kartu tidak ditemukan')
            ->assertJsonPath('data.bpjs_no_pendaftaran', null);

        $this->assertDatabaseHas('pendaftarans', [
            'no_kartu' => '9999999999999',
            'bpjs_error' => 'Nomor kartu tidak ditemukan',
        ]);
    }

    public function test_it_deletes_pendaftaran_on_bpjs_success(): void
    {
        $this->actingUser();
        $pendaftaran = Pendaftaran::factory()->create(['bpjs_no_pendaftaran' => 'PDF0002']);

        Http::fake([
            '*' => Http::response(['metaData' => ['code' => '200', 'message' => 'OK'], 'response' => null], 200),
        ]);

        $this->deleteJson("/api/v1/pendaftarans/{$pendaftaran->id}")->assertNoContent();

        $this->assertDatabaseMissing('pendaftarans', ['id' => $pendaftaran->id]);
    }

    public function test_guest_cannot_access_pendaftarans(): void
    {
        $this->getJson('/api/v1/pendaftarans')->assertStatus(401);
    }
}
