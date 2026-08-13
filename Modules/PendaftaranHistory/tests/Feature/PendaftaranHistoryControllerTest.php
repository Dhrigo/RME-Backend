<?php

namespace Modules\PendaftaranHistory\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\PendaftaranHistory\Models\RegistrationHistory;
use Modules\PendaftaranRegistration\Models\Registration;
use Tests\TestCase;

class PendaftaranHistoryControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_records_a_status_change(): void
    {
        $user = $this->actingUser();
        $registration = Registration::factory()->create(['status' => 'pending']);

        $response = $this->postJson('/api/v1/registration-histories', [
            'registration_id' => $registration->id,
            'old_status' => 'pending',
            'new_status' => 'confirmed',
        ]);

        $response->assertCreated()->assertJsonPath('data.new_status', 'confirmed');
        $this->assertDatabaseHas('registration_histories', [
            'registration_id' => $registration->id,
            'changed_by' => $user->id,
        ]);
    }

    public function test_it_requires_a_new_status(): void
    {
        $this->actingUser();
        $registration = Registration::factory()->create();

        $this->postJson('/api/v1/registration-histories', ['registration_id' => $registration->id])
            ->assertStatus(422);
    }

    public function test_it_lists_history_filtered_by_registration_ordered_latest_first(): void
    {
        $this->actingUser();
        $registration = Registration::factory()->create();
        $older = RegistrationHistory::factory()->create(['registration_id' => $registration->id, 'changed_at' => now()->subHour()]);
        $newer = RegistrationHistory::factory()->create(['registration_id' => $registration->id, 'changed_at' => now()]);
        RegistrationHistory::factory()->create();

        $response = $this->getJson("/api/v1/registration-histories?registration_id={$registration->id}");

        $response->assertOk()->assertJsonCount(2, 'data');
        $this->assertEquals($newer->id, $response->json('data.0.id'));
    }

    public function test_guest_cannot_access_registration_histories(): void
    {
        $this->getJson('/api/v1/registration-histories')->assertStatus(401);
    }
}
