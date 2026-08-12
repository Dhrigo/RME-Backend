<?php

namespace Modules\PendaftaranGuarantor\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\PendaftaranGuarantor\Models\Guarantor;
use Modules\PendaftaranRegistration\Models\Registration;
use Tests\TestCase;

class GuarantorControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_assigns_bpjs_guarantor_to_registration(): void
    {
        $user = $this->actingUser();
        $registration = Registration::factory()->create();

        $response = $this->postJson('/api/v1/guarantors', [
            'registration_id' => $registration->id,
            'payer_type' => 'bpjs',
            'member_number' => '0001234567890',
        ]);

        $response->assertCreated()->assertJsonPath('data.payer_type', 'bpjs');
        $this->assertDatabaseHas('guarantors', ['registration_id' => $registration->id, 'created_by' => $user->id]);
    }

    public function test_it_rejects_invalid_payer_type(): void
    {
        $this->actingUser();
        $registration = Registration::factory()->create();

        $this->postJson('/api/v1/guarantors', [
            'registration_id' => $registration->id,
            'payer_type' => 'crypto',
        ])->assertStatus(422);
    }

    public function test_it_defaults_to_self_pay(): void
    {
        $this->actingUser();
        $guarantor = Guarantor::factory()->create();

        $this->assertEquals('self_pay', $guarantor->payer_type);
    }

    public function test_it_lists_guarantors_filtered_by_registration(): void
    {
        $this->actingUser();
        $registration = Registration::factory()->create();
        Guarantor::factory()->create(['registration_id' => $registration->id]);
        Guarantor::factory()->create();

        $this->getJson("/api/v1/guarantors?registration_id={$registration->id}")
            ->assertOk()
            ->assertJsonCount(1, 'data');
    }
}
