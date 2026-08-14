<?php

namespace Modules\BpjsVClaim\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Modules\Auth\Models\User;
use Modules\BpjsVClaim\Models\Sep;
use Tests\TestCase;

class SepPengajuanControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_submits_a_fingerprint_exception_pengajuan(): void
    {
        Http::fake(['*' => Http::response(['metaData' => ['code' => '200', 'message' => 'Ok']])]);

        $this->actingUser();
        $sep = Sep::factory()->create();

        $response = $this->postJson('/api/v1/sep-pengajuans', [
            'sep_id' => $sep->id,
            'jenis' => 'fingerprint',
            'alasan' => 'Sidik jari peserta tidak terbaca',
        ]);

        $response->assertCreated();
        $this->assertSame('submitted', $response->json('data.status'));
    }

    public function test_it_records_hospital_level_fingerprint_approval(): void
    {
        Http::fake(['*' => Http::response(['metaData' => ['code' => '200', 'message' => 'Ok']])]);

        $this->actingUser();
        $sep = Sep::factory()->create();
        $create = $this->postJson('/api/v1/sep-pengajuans', [
            'sep_id' => $sep->id,
            'jenis' => 'fingerprint',
            'alasan' => 'Sidik jari peserta tidak terbaca',
        ]);
        $id = $create->json('data.id');

        $response = $this->postJson("/api/v1/sep-pengajuans/{$id}/approve", ['approved' => true]);

        $response->assertOk();
        $this->assertSame('approved', $response->json('data.status'));
    }
}
