<?php

namespace Modules\BpjsVClaim\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Modules\Auth\Models\User;
use Modules\BpjsVClaim\Models\Sep;
use Modules\GeneralDoctor\Models\Doctor;
use Modules\GeneralPatient\Models\Patient;
use Tests\TestCase;

class SepControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_sep_igd_and_records_bpjs_success(): void
    {
        Http::fake([
            '*' => Http::response([
                'metaData' => ['code' => '200', 'message' => 'Ok'],
                'response' => ['sep' => ['noSep' => '0001R0011123V000001']],
            ]),
        ]);

        $this->actingUser();
        $patient = Patient::factory()->create();
        $doctor = Doctor::factory()->create();

        $response = $this->postJson('/api/v1/seps', [
            'visit_type' => 'igd',
            'patient_id' => $patient->id,
            'no_kartu' => '0001112233445',
            'tgl_sep' => now()->toDateString(),
            'dpjp_doctor_id' => $doctor->id,
            'diagnosa_awal' => 'A00.0',
            'status_kecelakaan' => '0',
        ]);

        $response->assertCreated();
        $this->assertSame('success', $response->json('data.local_status'));
        $this->assertSame('0001R0011123V000001', $response->json('data.no_sep'));
        $this->assertDatabaseHas('seps', [
            'no_kartu' => '0001112233445',
            'local_status' => 'success',
        ]);
    }

    public function test_it_records_bpjs_error_without_a_sep_number(): void
    {
        Http::fake([
            '*' => Http::response([
                'metaData' => ['code' => '201', 'message' => 'Peserta tidak ditemukan'],
            ]),
        ]);

        $this->actingUser();
        $patient = Patient::factory()->create();
        $doctor = Doctor::factory()->create();

        $response = $this->postJson('/api/v1/seps', [
            'visit_type' => 'igd',
            'patient_id' => $patient->id,
            'no_kartu' => '0001112233445',
            'tgl_sep' => now()->toDateString(),
            'dpjp_doctor_id' => $doctor->id,
            'diagnosa_awal' => 'A00.0',
            'status_kecelakaan' => '0',
        ]);

        $response->assertCreated();
        $this->assertSame('error', $response->json('data.local_status'));
        $this->assertSame('Peserta tidak ditemukan', $response->json('data.error_message'));
        $this->assertNull($response->json('data.no_sep'));
    }

    public function test_rujukan_lanjutan_requires_no_rujukan_and_poli(): void
    {
        $this->actingUser();
        $patient = Patient::factory()->create();

        $response = $this->postJson('/api/v1/seps', [
            'visit_type' => 'rujukan_lanjutan',
            'patient_id' => $patient->id,
            'no_kartu' => '0001112233445',
            'tgl_sep' => now()->toDateString(),
            'status_kecelakaan' => '0',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['no_rujukan', 'poli_tujuan']);
    }

    public function test_accident_status_requires_region_codes(): void
    {
        $this->actingUser();
        $patient = Patient::factory()->create();
        $doctor = Doctor::factory()->create();

        $response = $this->postJson('/api/v1/seps', [
            'visit_type' => 'igd',
            'patient_id' => $patient->id,
            'no_kartu' => '0001112233445',
            'tgl_sep' => now()->toDateString(),
            'dpjp_doctor_id' => $doctor->id,
            'diagnosa_awal' => 'A00.0',
            'status_kecelakaan' => '1',
        ]);

        $response->assertStatus(422)->assertJsonValidationErrors([
            'kecelakaan_provinsi_code', 'kecelakaan_kabupaten_code', 'kecelakaan_kecamatan_code',
        ]);
    }

    public function test_delete_marks_local_status_deleted_on_bpjs_success(): void
    {
        Http::fake(['*' => Http::response(['metaData' => ['code' => '200', 'message' => 'Ok']])]);

        $this->actingUser();
        $sep = Sep::factory()->create(['no_sep' => '0001R0011123V000001', 'local_status' => 'success']);

        $response = $this->deleteJson("/api/v1/seps/{$sep->id}");

        $response->assertOk();
        $this->assertSame('deleted', $sep->fresh()->local_status);
    }

    public function test_delete_keeps_record_when_bpjs_rejects(): void
    {
        Http::fake(['*' => Http::response(['metaData' => ['code' => '201', 'message' => 'SEP sudah diverifikasi']])]);

        $this->actingUser();
        $sep = Sep::factory()->create(['no_sep' => '0001R0011123V000001', 'local_status' => 'success']);

        $response = $this->deleteJson("/api/v1/seps/{$sep->id}");

        $response->assertStatus(422);
        $this->assertSame('success', $sep->fresh()->local_status);
        $this->assertSame('SEP sudah diverifikasi', $sep->fresh()->error_message);
    }

    public function test_guest_cannot_access_seps(): void
    {
        $this->getJson('/api/v1/seps')->assertStatus(401);
    }
}
