<?php

namespace Modules\PendaftaranVisit\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\PendaftaranRegistration\Models\Registration;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

class VisitControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_admits_a_visit_under_a_registration(): void
    {
        $this->actingUser();
        $registration = Registration::factory()->create();

        $response = $this->postJson('/api/v1/visits', ['registration_id' => $registration->id]);

        $response->assertCreated();
        $this->assertStringStartsWith('KJ-'.now()->format('Y').'-', $response->json('data.visit_number'));
    }

    public function test_it_lists_visits_filtered_by_registration(): void
    {
        $this->actingUser();
        $registration = Registration::factory()->create();
        Visit::factory()->count(2)->create(['registration_id' => $registration->id]);
        Visit::factory()->create();

        $response = $this->getJson("/api/v1/visits?registration_id={$registration->id}");

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_discharges_a_visit(): void
    {
        $user = $this->actingUser();
        $visit = Visit::factory()->create();

        $response = $this->putJson("/api/v1/visits/{$visit->id}", [
            'discharged_at' => now()->toIso8601String(),
            'final_outcome' => 'sembuh',
        ]);

        $response->assertOk()->assertJsonPath('data.status', 'discharged');
        $this->assertDatabaseHas('visits', ['id' => $visit->id, 'final_outcome_by' => $user->id]);
    }
}
