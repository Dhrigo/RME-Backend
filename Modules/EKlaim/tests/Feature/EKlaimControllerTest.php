<?php

namespace Modules\EKlaim\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Modules\Auth\Models\User;
use Modules\EKlaim\Services\EklaimCrypto;
use Tests\TestCase;

class EKlaimControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_calls_ws_php_and_decrypts_the_response(): void
    {
        $key = bin2hex(random_bytes(32));
        config(['eklaim.key' => $key, 'eklaim.base_url' => 'http://eklaim.test/E-Klaim']);

        $crypto = new EklaimCrypto();
        $wireResponse = $crypto->encrypt(json_encode(['status' => 0, 'detail' => 'OK', 'nomor_sep' => 'SEP1']), $key);

        Http::fake([
            '*/ws.php' => Http::response("----BEGIN ENCRYPTED DATA----\r\n{$wireResponse}----END ENCRYPTED DATA----\r\n"),
        ]);

        $this->actingUser();

        $response = $this->postJson('/api/v1/eklaim/calls', [
            'method' => 'claim_print',
            'data' => ['nomor_sep' => 'SEP1'],
        ]);

        $response->assertCreated();
        $this->assertSame('sent', $response->json('status'));
        $this->assertSame('OK', $response->json('response_data.detail'));

        Http::assertSent(function ($request) {
            return str_ends_with($request->url(), '/ws.php')
                && $request->hasHeader('Content-Type', 'application/x-www-form-urlencoded');
        });
    }
}
