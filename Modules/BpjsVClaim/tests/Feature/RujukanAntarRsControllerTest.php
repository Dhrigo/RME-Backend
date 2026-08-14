<?php

namespace Modules\BpjsVClaim\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Modules\Auth\Models\User;
use Modules\BpjsVClaim\Models\RujukanAntarRs;
use Modules\GeneralPatient\Models\Patient;
use Tests\TestCase;

class RujukanAntarRsControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_rujukan_antar_rs_and_stores_the_returned_number(): void
    {
        Http::fake([
            '*' => Http::response([
                'metaData' => ['code' => '200', 'message' => 'Ok'],
                'response' => ['rujukan' => ['noRujukan' => '0001R0011123R000001']],
            ]),
        ]);

        $this->actingUser();
        $patient = Patient::factory()->create();

        $response = $this->postJson('/api/v1/rujukan-antar-rs', [
            'patient_id' => $patient->id,
            'no_sep_asal' => '0001R0011123V000001',
            'tanggal_rencana_kunjungan' => now()->addDay()->toDateString(),
            'jenis_pelayanan' => '2',
            'tipe_rujukan' => '0',
            'ppk_tujuan' => '0001234',
            'diagnosa' => 'A00.0',
        ]);

        $response->assertCreated();
        $this->assertSame('0001R0011123R000001', $response->json('data.no_rujukan'));
        $this->assertSame('success', $response->json('data.local_status'));
    }

    public function test_delete_blocked_after_sep_issued_keeps_record_with_error(): void
    {
        Http::fake(['*' => Http::response(['metaData' => ['code' => '201', 'message' => 'SEP sudah diterbitkan']])]);

        $this->actingUser();
        $rujukan = RujukanAntarRs::factory()->create(['no_rujukan' => '0001R0011123R000001', 'local_status' => 'success']);

        $response = $this->deleteJson("/api/v1/rujukan-antar-rs/{$rujukan->id}");

        $response->assertStatus(422);
        $this->assertSame('success', $rujukan->fresh()->local_status);
    }
}
