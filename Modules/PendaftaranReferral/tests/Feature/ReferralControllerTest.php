<?php

namespace Modules\PendaftaranReferral\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranReferral\Models\Referral;
use Tests\TestCase;

class ReferralControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_records_a_referral_with_auto_generated_number(): void
    {
        $this->actingUser();
        $patient = Patient::factory()->create();

        $response = $this->postJson('/api/v1/referrals', [
            'patient_id' => $patient->id,
            'direction' => 'incoming',
            'facility_name' => 'Puskesmas Sehat',
        ]);

        $response->assertCreated();
        $this->assertStringStartsWith('RUJ-'.now()->format('Y').'-', $response->json('data.referral_number'));
    }

    public function test_it_lists_referrals_filtered_by_patient(): void
    {
        $this->actingUser();
        $patient = Patient::factory()->create();
        Referral::factory()->count(2)->create(['patient_id' => $patient->id]);
        Referral::factory()->create();

        $response = $this->getJson("/api/v1/referrals?patient_id={$patient->id}");

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_updates_referral_status(): void
    {
        $this->actingUser();
        $referral = Referral::factory()->create(['status' => 'pending']);

        $response = $this->putJson("/api/v1/referrals/{$referral->id}", ['status' => 'accepted']);

        $response->assertOk()->assertJsonPath('data.status', 'accepted');
    }

    public function test_guest_cannot_access_referrals(): void
    {
        $this->getJson('/api/v1/referrals')->assertStatus(401);
    }
}
