<?php

namespace Modules\SatuSehatPtmRegistry\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Modules\Auth\Models\User;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class BundleControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    private function bundle(): array
    {
        return [
            'resourceType' => 'Bundle',
            'type' => 'transaction',
            'identifier' => ['system' => 'http://sys-ids.kemkes.go.id/ptm', 'value' => 'PTM-0001'],
            'entry' => [
                ['resource' => ['resourceType' => 'Condition', 'clinicalStatus' => 'active']],
            ],
        ];
    }

    #[DataProvider('useCaseEndpoints')]
    public function test_it_submits_bundle_for_use_case(string $endpoint): void
    {
        Http::fake([
            '*/accesstoken*' => Http::response(['access_token' => 'tok', 'expires_in' => 3600]),
            '*/Bundle' => Http::response(['id' => 'satusehat-bundle-1']),
        ]);

        $this->actingUser();

        $response = $this->postJson("/api/v1/satusehat/ptm-registry/{$endpoint}", $this->bundle());

        $response->assertCreated();
        $this->assertSame('sent', $response->json('data.status'));
    }

    public static function useCaseEndpoints(): array
    {
        return [
            ['skrining-ptm/bundle'],
            ['kanker/bundle'],
            ['jantung/bundle'],
            ['stroke/bundle'],
            ['uronefrologi/bundle'],
        ];
    }

    public function test_it_rejects_bundle_without_resource_type(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/satusehat/ptm-registry/skrining-ptm/bundle', ['entry' => []])->assertStatus(422);
    }

    public function test_guest_cannot_submit(): void
    {
        $this->postJson('/api/v1/satusehat/ptm-registry/skrining-ptm/bundle', $this->bundle())->assertStatus(401);
    }
}
