<?php

namespace Modules\BpjsVClaim\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Modules\Auth\Models\User;
use Modules\BpjsVClaim\Models\Sep;
use Tests\TestCase;

class SpriControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_an_spri_and_stores_the_returned_number(): void
    {
        Http::fake([
            '*' => Http::response([
                'metaData' => ['code' => '200', 'message' => 'Ok'],
                'response' => ['noSPRI' => '0001R0011123S000001'],
            ]),
        ]);

        $this->actingUser();
        $sep = Sep::factory()->create(['local_status' => 'success', 'no_sep' => '0001R0011123V000001']);

        $response = $this->postJson('/api/v1/spris', [
            'sep_id' => $sep->id,
            'tanggal_rencana_rawat_inap' => now()->addDays(2)->toDateString(),
        ]);

        $response->assertCreated();
        $this->assertSame('0001R0011123S000001', $response->json('data.no_spri'));
        $this->assertSame('success', $response->json('data.local_status'));
    }
}
