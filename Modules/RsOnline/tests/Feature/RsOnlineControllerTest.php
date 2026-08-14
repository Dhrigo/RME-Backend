<?php

namespace Modules\RsOnline\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Modules\Auth\Models\User;
use Tests\TestCase;

class RsOnlineControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_pushes_sdm_data_and_records_local_status(): void
    {
        Http::fake(['*' => Http::response(['success' => true])]);

        $this->actingUser();

        $response = $this->postJson('/api/v1/rs-online/data/sdm', ['nama' => 'dr. Contoh']);

        $response->assertCreated();
        $this->assertSame('sent', $response->json('status'));
        $this->assertSame('data_sdm', $response->json('resource'));
    }
}
