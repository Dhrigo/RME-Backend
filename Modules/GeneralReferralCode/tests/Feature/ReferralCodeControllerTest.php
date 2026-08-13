<?php

namespace Modules\GeneralReferralCode\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralReferralCode\Models\ReferralCode;
use Tests\TestCase;

class ReferralCodeControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_referral_codes(): void
    {
        $this->actingUser();
        ReferralCode::factory()->count(3)->create();

        $this->getJson('/api/v1/referral-codes')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_referral_code(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/referral-codes', [
            'code' => 'Test Code',
            'name' => 'Test Name',
        ])->assertCreated();

        $this->assertDatabaseCount('referral_codes', 1);
    }

    public function test_it_deletes_referral_code(): void
    {
        $this->actingUser();
        $referral_code = ReferralCode::factory()->create();

        $this->deleteJson("/api/v1/referral-codes/{$referral_code->id}")->assertStatus(204);
        $this->assertDatabaseMissing('referral_codes', ['id' => $referral_code->id]);
    }

    public function test_it_shows_referral_code(): void
    {
        $this->actingUser();
        $referral_code = ReferralCode::factory()->create();

        $this->getJson("/api/v1/referral-codes/{$referral_code->id}")->assertOk()->assertJsonPath('data.id', $referral_code->id);
    }

}
