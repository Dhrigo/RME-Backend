<?php

namespace Modules\BpjsRekamMedis\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Modules\Auth\Models\User;
use Modules\Bpjs\Services\BpjsCrypto;
use Modules\BpjsRekamMedis\Models\Klaim;
use Tests\TestCase;

class KlaimControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    private function configureCredentials(): void
    {
        config([
            'bpjs.families.smartclaim.cons_id' => 'CONS-SC',
            'bpjs.families.smartclaim.secret_key' => 'SECRET-SC',
            'bpjs.families.smartclaim.user_key' => 'USER-SC',
            'bpjs.families.rekam_medis.base_url' => 'https://erekammedis.example/erekammedis_dev',
            'bpjs.koders' => '0001R001',
        ]);
    }

    private function payload(): array
    {
        return [
            'no_sep' => '0001R0011123V000001',
            'jenis_pelayanan_id' => '2',
            'bulan' => '08',
            'tahun' => '2026',
            'composition' => ['title' => 'Ringkasan Rawat Jalan', 'date' => '2026-08-14'],
            'patient' => [
                'id' => 501,
                'mr_number' => 'RM-2026-000501',
                'name' => 'TRI MULYANI',
                'gender' => 'female',
                'birth_date' => '1990-01-01',
                'marital_status_code' => 'M',
            ],
            'encounter' => ['id' => 901, 'status' => 'finished', 'class_code' => 'AMB'],
            'practitioner' => ['id' => 11, 'name' => 'dr. Budi', 'identifier' => '11111'],
            'organization' => ['id' => 1, 'name' => 'RS SIMGOS', 'identifier' => '0001R001'],
            'conditions' => [['id' => 1, 'code' => 'A00.0', 'display' => 'Cholera']],
        ];
    }

    public function test_it_submits_bundle_and_records_success(): void
    {
        $this->configureCredentials();
        $crypto = new BpjsCrypto;

        Http::fake(function ($request) use ($crypto) {
            $this->assertStringContainsString('rekammedis/insert', $request->url());

            $dataMR = $request->data()['request']['dataMR'];
            $decrypted = $crypto->decryptGzip(base64_decode($dataMR), 'CONS-SC', 'SECRET-SC', '0001R001');
            $bundle = json_decode($decrypted, true);

            $this->assertSame('Bundle', $bundle['resourceType']);
            $this->assertSame('document', $bundle['type']);
            $this->assertSame('0001R0011123V000001', $bundle['identifier']['value']);

            $resourceTypes = array_map(fn ($e) => $e['resource']['resourceType'], $bundle['entry']);
            $this->assertContains('Composition', $resourceTypes);
            $this->assertContains('Patient', $resourceTypes);
            $this->assertContains('Encounter', $resourceTypes);
            $this->assertContains('Practitioner', $resourceTypes);
            $this->assertContains('Organization', $resourceTypes);
            $this->assertContains('Condition', $resourceTypes);

            return Http::response(['metadata' => ['code' => 200, 'message' => 'Ok']]);
        });

        $this->actingUser();

        $response = $this->postJson('/api/v1/klaims', $this->payload());

        $response->assertCreated();
        $this->assertSame('sent', $response->json('data.status'));
        $this->assertDatabaseHas('klaims', [
            'no_sep' => '0001R0011123V000001',
            'status' => 'sent',
        ]);
    }

    public function test_it_records_error_when_bpjs_rejects(): void
    {
        $this->configureCredentials();

        Http::fake(['*' => Http::response(['metadata' => ['code' => 201, 'message' => 'Data tidak valid']])]);

        $this->actingUser();

        $response = $this->postJson('/api/v1/klaims', $this->payload());

        $response->assertStatus(422);
        $this->assertSame('error', $response->json('data.status'));
        $this->assertSame('Data tidak valid', $response->json('data.error_message'));
    }

    public function test_resubmitting_the_same_sep_and_service_reuses_the_klaim_record(): void
    {
        $this->configureCredentials();
        Http::fake(['*' => Http::response(['metadata' => ['code' => 200, 'message' => 'Ok']])]);

        $this->actingUser();

        $this->postJson('/api/v1/klaims', $this->payload())->assertCreated();
        $this->postJson('/api/v1/klaims', $this->payload())->assertCreated();

        $this->assertSame(1, Klaim::query()->where('no_sep', '0001R0011123V000001')->count());
    }

    public function test_guest_cannot_submit_klaims(): void
    {
        $this->postJson('/api/v1/klaims', $this->payload())->assertStatus(401);
    }
}
