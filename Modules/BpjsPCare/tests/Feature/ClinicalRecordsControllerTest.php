<?php

namespace Modules\BpjsPCare\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Modules\Auth\Models\User;
use Modules\BpjsPCare\Models\Kunjungan;
use Tests\TestCase;

/**
 * Covers the five encounter-scoped clinical entities that share the same
 * BPJS call+persist shape (MCU, Alergi, Prognosa, Skrinning, Tindakan) -
 * one create test per entity to confirm the right BPJS endpoint is hit and
 * the record is FK'd to its parent Kunjungan.
 */
class ClinicalRecordsControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    private function bpjsOk(): void
    {
        Http::fake([
            '*' => Http::response(['metaData' => ['code' => '200', 'message' => 'OK'], 'response' => ['id' => 'BPJS001']], 200),
        ]);
    }

    public function test_it_creates_mcu_scoped_to_kunjungan(): void
    {
        $this->actingUser();
        $this->bpjsOk();
        $kunjungan = Kunjungan::factory()->create();

        $this->postJson('/api/v1/mcus', [
            'kunjungan_id' => $kunjungan->id,
            'tanggal_mcu' => '2026-08-14',
            'tinggi_badan' => 165.5,
            'berat_badan' => 60.2,
        ])->assertCreated()->assertJsonPath('data.kunjungan_id', $kunjungan->id);

        $this->assertDatabaseHas('mcus', ['kunjungan_id' => $kunjungan->id]);
        Http::assertSent(fn ($request) => str_contains($request->url(), '/mcu'));
    }

    public function test_it_creates_alergi_scoped_to_kunjungan(): void
    {
        $this->actingUser();
        $this->bpjsOk();
        $kunjungan = Kunjungan::factory()->create();

        $this->postJson('/api/v1/alergis', [
            'kunjungan_id' => $kunjungan->id,
            'jenis_alergi' => 'obat',
            'nama_alergi' => 'Amoxicillin',
        ])->assertCreated()->assertJsonPath('data.jenis_alergi', 'obat');

        $this->assertDatabaseHas('alergis', ['kunjungan_id' => $kunjungan->id, 'nama_alergi' => 'Amoxicillin']);
    }

    public function test_it_creates_prognosa_scoped_to_kunjungan(): void
    {
        $this->actingUser();
        $this->bpjsOk();
        $kunjungan = Kunjungan::factory()->create();

        $this->postJson('/api/v1/prognosas', [
            'kunjungan_id' => $kunjungan->id,
            'kode_diagnosa' => 'A00',
            'nama_diagnosa' => 'Kolera',
            'hasil_prognosa' => 'membaik',
        ])->assertCreated()->assertJsonPath('data.hasil_prognosa', 'membaik');

        $this->assertDatabaseHas('prognosas', ['kunjungan_id' => $kunjungan->id]);
    }

    public function test_it_creates_skrinning_scoped_to_kunjungan(): void
    {
        $this->actingUser();
        $this->bpjsOk();
        $kunjungan = Kunjungan::factory()->create();

        $this->postJson('/api/v1/skrinnings', [
            'kunjungan_id' => $kunjungan->id,
            'jenis_skrinning' => 'gaya_hidup',
            'pertanyaan' => 'Apakah anda merokok?',
            'jawaban' => 'Tidak',
        ])->assertCreated()->assertJsonPath('data.jenis_skrinning', 'gaya_hidup');

        $this->assertDatabaseHas('skrinnings', ['kunjungan_id' => $kunjungan->id]);
    }

    public function test_it_creates_tindakan_scoped_to_kunjungan(): void
    {
        $this->actingUser();
        $this->bpjsOk();
        $kunjungan = Kunjungan::factory()->create();

        $this->postJson('/api/v1/tindakans', [
            'kunjungan_id' => $kunjungan->id,
            'kode_tindakan' => '99.01',
            'nama_tindakan' => 'Nebulizer',
            'tanggal_tindakan' => '2026-08-14',
        ])->assertCreated()->assertJsonPath('data.nama_tindakan', 'Nebulizer');

        $this->assertDatabaseHas('tindakans', ['kunjungan_id' => $kunjungan->id]);
    }

    public function test_bpjs_failure_is_stored_locally_without_blocking_the_record(): void
    {
        $this->actingUser();
        Http::fake([
            '*' => Http::response(['metaData' => ['code' => '500', 'message' => 'Service unavailable'], 'response' => null], 200),
        ]);
        $kunjungan = Kunjungan::factory()->create();

        $response = $this->postJson('/api/v1/tindakans', [
            'kunjungan_id' => $kunjungan->id,
            'kode_tindakan' => '99.02',
            'nama_tindakan' => 'Injeksi',
            'tanggal_tindakan' => '2026-08-14',
        ]);

        $response->assertCreated()->assertJsonPath('data.bpjs_error', 'Service unavailable');
        $this->assertDatabaseHas('tindakans', ['kunjungan_id' => $kunjungan->id, 'bpjs_error' => 'Service unavailable']);
    }
}
