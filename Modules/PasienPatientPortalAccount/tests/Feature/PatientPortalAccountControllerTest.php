<?php

namespace Modules\PasienPatientPortalAccount\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\PasienPatientPortalAccount\Models\PatientPortalAccount;
use Tests\TestCase;

class PatientPortalAccountControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_portal_accounts(): void
    {
        $this->actingUser();
        PatientPortalAccount::factory()->count(3)->create();

        $this->getJson('/api/v1/patient-portal-accounts')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_portal_account(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/patient-portal-accounts', [
            'patient_id' => \Modules\GeneralPatient\Models\Patient::factory()->create()->id,
            'username' => 'Test Username',
        ])->assertCreated();

        $this->assertDatabaseCount('patient_portal_accounts', 1);
    }

    public function test_it_deletes_portal_account(): void
    {
        $this->actingUser();
        $portal_account = PatientPortalAccount::factory()->create();

        $this->deleteJson("/api/v1/patient-portal-accounts/{$portal_account->id}")->assertStatus(204);
        $this->assertDatabaseMissing('patient_portal_accounts', ['id' => $portal_account->id]);
    }

    public function test_it_shows_portal_account(): void
    {
        $this->actingUser();
        $portal_account = PatientPortalAccount::factory()->create();

        $this->getJson("/api/v1/patient-portal-accounts/{$portal_account->id}")->assertOk()->assertJsonPath('data.id', $portal_account->id);
    }

}
