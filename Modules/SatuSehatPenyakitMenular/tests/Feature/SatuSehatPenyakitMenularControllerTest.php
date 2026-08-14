<?php

namespace Modules\SatuSehatPenyakitMenular\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Modules\Auth\Models\User;
use Tests\TestCase;

class SatuSehatPenyakitMenularControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_submits_a_tuberkulosis_bundle_and_records_local_status(): void
    {
        Http::fake([
            '*/accesstoken*' => Http::response(['access_token' => 'tok', 'expires_in' => 3600]),
            '*/Bundle' => Http::response(['id' => 'bundle-1']),
        ]);

        $this->actingUser();

        $response = $this->postJson('/api/v1/satu-sehat-penyakit-menular/tuberkulosis', [
            'resource_type' => 'Bundle',
            'payload' => ['resourceType' => 'Bundle', 'type' => 'transaction'],
            'encounter_local_id' => 42,
        ]);

        $response->assertCreated();
        $this->assertSame('sent', $response->json('status'));
        $this->assertSame('tuberkulosis', $response->json('use_case'));
    }

    public function test_it_rejects_unknown_use_case(): void
    {
        $this->actingUser();

        $response = $this->postJson('/api/v1/satu-sehat-penyakit-menular/unknown', [
            'resource_type' => 'Bundle',
            'payload' => ['resourceType' => 'Bundle'],
        ]);

        $response->assertStatus(405);
    }
}
