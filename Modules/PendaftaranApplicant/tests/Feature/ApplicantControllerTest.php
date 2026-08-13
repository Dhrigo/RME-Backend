<?php

namespace Modules\PendaftaranApplicant\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\PendaftaranApplicant\Models\Applicant;
use Modules\PendaftaranRegistration\Models\Registration;
use Tests\TestCase;

class ApplicantControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_an_applicant(): void
    {
        $user = $this->actingUser();
        $registration = Registration::factory()->create();

        $response = $this->postJson('/api/v1/applicants', [
            'registration_id' => $registration->id,
            'full_name' => 'Andi Wijaya',
            'relationship_to_patient' => 'parent',
            'application_type' => 'referral',
        ]);

        $response->assertCreated()->assertJsonPath('data.application_type', 'referral');
        $this->assertDatabaseHas('applicants', ['registration_id' => $registration->id, 'created_by' => $user->id]);
    }

    public function test_it_rejects_invalid_application_type(): void
    {
        $this->actingUser();
        $registration = Registration::factory()->create();

        $this->postJson('/api/v1/applicants', [
            'registration_id' => $registration->id,
            'full_name' => 'Andi Wijaya',
            'relationship_to_patient' => 'self',
            'application_type' => 'discount_request',
        ])->assertStatus(422);
    }

    public function test_it_defaults_to_submitted_status(): void
    {
        $this->actingUser();
        $applicant = Applicant::factory()->create();

        $this->assertEquals('submitted', $applicant->status);
    }

    public function test_it_lists_applicants_filtered_by_registration(): void
    {
        $this->actingUser();
        $registration = Registration::factory()->create();
        Applicant::factory()->create(['registration_id' => $registration->id]);
        Applicant::factory()->create();

        $this->getJson("/api/v1/applicants?registration_id={$registration->id}")
            ->assertOk()
            ->assertJsonCount(1, 'data');
    }

    public function test_it_deletes_an_applicant(): void
    {
        $this->actingUser();
        $applicant = Applicant::factory()->create();

        $this->deleteJson("/api/v1/applicants/{$applicant->id}")->assertStatus(204);
        $this->assertDatabaseMissing('applicants', ['id' => $applicant->id]);
    }

    public function test_guest_cannot_access_applicants(): void
    {
        $this->getJson('/api/v1/applicants')->assertStatus(401);
    }
}
