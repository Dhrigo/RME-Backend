<?php

namespace Modules\SatuSehatMasterData\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Modules\Auth\Models\User;
use Tests\TestCase;

class MasterDataControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_proxies_provinces_lookup(): void
    {
        Http::fake([
            '*/accesstoken*' => Http::response(['access_token' => 'tok', 'expires_in' => 3600]),
            '*/masterdata/v1/provinces*' => Http::response(['data' => [['code' => '11', 'name' => 'ACEH']]]),
        ]);

        $this->actingUser();

        $response = $this->getJson('/api/v1/satusehat/master-data/provinces');

        $response->assertOk();
        $this->assertSame('11', $response->json('data.0.code'));

        Http::assertSent(fn ($request) => str_contains($request->url(), '/masterdata/v1/provinces') || str_contains($request->url(), 'accesstoken'));
    }

    public function test_it_proxies_kfa_product_lookup_with_required_query_params(): void
    {
        Http::fake([
            '*/accesstoken*' => Http::response(['access_token' => 'tok', 'expires_in' => 3600]),
            '*/kfa-v2/products*' => Http::response(['data' => ['kfa_code' => '93000108']]),
        ]);

        $this->actingUser();

        $response = $this->getJson('/api/v1/satusehat/master-data/kfa/products?identifier=kfa&code=93000108');

        $response->assertOk();

        Http::assertSent(function ($request) {
            if (! str_contains($request->url(), 'kfa-v2/products')) {
                return true;
            }

            return $request['identifier'] === 'kfa' && $request['code'] === '93000108';
        });
    }

    public function test_kfa_product_lookup_requires_identifier_and_code(): void
    {
        $this->actingUser();

        $this->getJson('/api/v1/satusehat/master-data/kfa/products')->assertStatus(422);
    }

    public function test_guest_cannot_access(): void
    {
        $this->getJson('/api/v1/satusehat/master-data/provinces')->assertStatus(401);
    }
}
