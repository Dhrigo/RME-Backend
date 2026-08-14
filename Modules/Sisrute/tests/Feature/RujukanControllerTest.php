<?php

namespace Modules\Sisrute\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Modules\Auth\Models\User;
use Tests\TestCase;

class RujukanControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_sends_a_rujukan_and_records_local_status(): void
    {
        Http::fake(['*' => Http::response(['no_rujukan' => 'RJ-001'])]);

        $this->actingUser();

        $response = $this->postJson('/api/v1/sisrute/rujukan', [
            'no_rm' => '0001234567',
        ]);

        $response->assertCreated();
        $this->assertSame('sent', $response->json('status'));
        $this->assertSame('RJ-001', $response->json('no_rujukan'));
    }

    public function test_it_records_failure_when_sisrute_rejects(): void
    {
        Http::fake(['*' => Http::response(['message' => 'invalid'], 422)]);

        $this->actingUser();

        $response = $this->postJson('/api/v1/sisrute/rujukan', [
            'no_rm' => '0001234567',
        ]);

        $response->assertCreated();
        $this->assertSame('failed', $response->json('status'));
    }
}
