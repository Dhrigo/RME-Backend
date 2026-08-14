<?php

namespace Modules\BpjsVClaim\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Modules\Auth\Models\User;
use Modules\BpjsVClaim\Models\Sep;
use Tests\TestCase;

class RencanaKontrolControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_rencana_kontrol_and_stores_the_returned_surat_number(): void
    {
        Http::fake([
            '*' => Http::response([
                'metaData' => ['code' => '200', 'message' => 'Ok'],
                'response' => ['noSuratKontrol' => '0001R0011123K000001'],
            ]),
        ]);

        $this->actingUser();
        $sep = Sep::factory()->create(['local_status' => 'success', 'no_sep' => '0001R0011123V000001']);

        $response = $this->postJson('/api/v1/rencana-kontrols', [
            'sep_id' => $sep->id,
            'jenis_kontrol' => '1',
            'poli_kontrol' => 'INT',
            'tanggal_rencana_kontrol' => now()->addWeek()->toDateString(),
        ]);

        $response->assertCreated();
        $this->assertSame('0001R0011123K000001', $response->json('data.no_surat_kontrol'));
        $this->assertSame('success', $response->json('data.local_status'));
    }

    public function test_it_records_error_when_bpjs_rejects(): void
    {
        Http::fake(['*' => Http::response(['metaData' => ['code' => '201', 'message' => 'SEP tidak ditemukan']])]);

        $this->actingUser();
        $sep = Sep::factory()->create();

        $response = $this->postJson('/api/v1/rencana-kontrols', [
            'sep_id' => $sep->id,
            'jenis_kontrol' => '1',
            'poli_kontrol' => 'INT',
            'tanggal_rencana_kontrol' => now()->addWeek()->toDateString(),
        ]);

        $response->assertCreated();
        $this->assertSame('error', $response->json('data.local_status'));
        $this->assertSame('SEP tidak ditemukan', $response->json('data.error_message'));
    }
}
