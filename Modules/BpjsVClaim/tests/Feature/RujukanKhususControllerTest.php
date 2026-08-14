<?php

namespace Modules\BpjsVClaim\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Modules\Auth\Models\User;
use Tests\TestCase;

class RujukanKhususControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_rujukan_khusus_and_stores_the_returned_number(): void
    {
        Http::fake([
            '*' => Http::response([
                'metaData' => ['code' => '200', 'message' => 'Ok'],
                'response' => ['noRujukan' => '0001R0011123X000001'],
            ]),
        ]);

        $this->actingUser();

        $response = $this->postJson('/api/v1/rujukan-khusus', [
            'no_rujukan_asal' => '0001R0011123R000001',
            'diagnosa' => 'N18.0',
            'kode_prosedur' => '39.95',
        ]);

        $response->assertCreated();
        $this->assertSame('0001R0011123X000001', $response->json('data.no_rujukan_khusus'));
        $this->assertSame('success', $response->json('data.local_status'));
    }
}
