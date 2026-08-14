<?php

namespace Modules\SatuSehatKptl\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Modules\Auth\Models\User;
use Tests\TestCase;

class KptlControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_calls_code_rpc_endpoint_with_get_all_code_method(): void
    {
        config(['satusehatkptl.base_url' => 'https://kptl.example']);

        Http::fake([
            '*/accesstoken*' => Http::response(['access_token' => 'tok', 'expires_in' => 3600]),
            'kptl.example/code' => Http::response(['data' => [['code' => '12027']]]),
        ]);

        $this->actingUser();

        $response = $this->postJson('/api/v1/satusehat/kptl/code', ['query_string' => '12027']);

        $response->assertOk();

        Http::assertSent(function ($request) {
            if (! str_contains($request->url(), 'kptl.example/code')) {
                return true;
            }

            $body = $request->data();

            return $body['method'] === 'get_all_code'
                && $body['query_string'] === '12027'
                && $request->hasHeader('X-Encryption-Disabled', 'true');
        });
    }

    public function test_it_calls_modifier_value_rpc_endpoint(): void
    {
        config(['satusehatkptl.base_url' => 'https://kptl.example']);

        Http::fake([
            '*/accesstoken*' => Http::response(['access_token' => 'tok', 'expires_in' => 3600]),
            'kptl.example/modifier_value' => Http::response(['data' => ['M006']]),
        ]);

        $this->actingUser();

        $response = $this->postJson('/api/v1/satusehat/kptl/modifier-value', ['query_string' => 'M006']);

        $response->assertOk();

        Http::assertSent(function ($request) {
            if (! str_contains($request->url(), 'modifier_value')) {
                return true;
            }

            return $request->data()['method'] === 'get_modifier_value';
        });
    }

    public function test_guest_cannot_access(): void
    {
        $this->postJson('/api/v1/satusehat/kptl/code', ['query_string' => '12027'])->assertStatus(401);
    }
}
