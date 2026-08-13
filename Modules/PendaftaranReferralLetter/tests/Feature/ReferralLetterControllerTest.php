<?php

namespace Modules\PendaftaranReferralLetter\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralMedicalDepartment\Models\MedicalDepartment;
use Modules\PendaftaranReferralLetter\Models\ReferralLetter;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

class ReferralLetterControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_can_list_referral_letters(): void
    {
        ReferralLetter::factory()->count(3)->create();

        $response = $this->actingAs($this->user)->getJson('/api/v1/referralletters');

        $response->assertOk()
            ->assertJsonCount(3, 'data');
    }

    public function test_can_create_referral_letter(): void
    {
        $visit = Visit::factory()->create();
        $fromDept = MedicalDepartment::factory()->create();
        $toDept = MedicalDepartment::factory()->create();

        $data = [
            'visit_id' => $visit->id,
            'from_department_id' => $fromDept->id,
            'to_department_id' => $toDept->id,
            'issued_at' => now()->toDateTimeString(),
            'notes' => 'Internal consultation',
        ];

        $response = $this->actingAs($this->user)->postJson('/api/v1/referralletters', $data);

        $response->assertCreated()
            ->assertJsonPath('data.notes', 'Internal consultation');

        $this->assertDatabaseHas('referral_letters', $data);
    }

    public function test_can_show_referral_letter(): void
    {
        $referral = ReferralLetter::factory()->create();

        $response = $this->actingAs($this->user)->getJson("/api/v1/referralletters/{$referral->id}");

        $response->assertOk()
            ->assertJsonPath('data.id', $referral->id);
    }
}
