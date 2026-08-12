<?php

namespace Modules\PembayaranDeposit\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\PembayaranDeposit\Models\Deposit;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

class DepositControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_records_a_deposit_with_auto_generated_number(): void
    {
        $user = $this->actingUser();
        $visit = Visit::factory()->create();

        $response = $this->postJson('/api/v1/deposits', [
            'visit_id' => $visit->id,
            'amount' => 500000,
        ]);

        $response->assertCreated()->assertJsonPath('data.status', 'held');
        $this->assertStringStartsWith('DEP-'.now()->format('Y').'-', $response->json('data.deposit_number'));
        $this->assertDatabaseHas('deposits', ['visit_id' => $visit->id, 'received_by' => $user->id]);
    }

    public function test_it_lists_deposits_filtered_by_visit(): void
    {
        $this->actingUser();
        $visit = Visit::factory()->create();
        Deposit::factory()->create(['visit_id' => $visit->id]);
        Deposit::factory()->create();

        $response = $this->getJson("/api/v1/deposits?visit_id={$visit->id}");

        $response->assertOk()->assertJsonCount(1, 'data');
    }

    public function test_it_applies_a_held_deposit(): void
    {
        $this->actingUser();
        $deposit = Deposit::factory()->create(['status' => 'held']);

        $response = $this->putJson("/api/v1/deposits/{$deposit->id}", ['status' => 'applied']);

        $response->assertOk()->assertJsonPath('data.status', 'applied');
    }

    public function test_it_rejects_updating_an_already_processed_deposit(): void
    {
        $this->actingUser();
        $deposit = Deposit::factory()->create(['status' => 'applied']);

        $this->putJson("/api/v1/deposits/{$deposit->id}", ['status' => 'refunded'])->assertStatus(422);
    }

    public function test_guest_cannot_access_deposits(): void
    {
        $this->getJson('/api/v1/deposits')->assertStatus(401);
    }
}
