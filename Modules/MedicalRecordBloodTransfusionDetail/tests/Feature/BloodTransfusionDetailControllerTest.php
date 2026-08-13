<?php

namespace Modules\MedicalRecordBloodTransfusionDetail\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordBloodTransfusion\Models\BloodTransfusion;
use Modules\MedicalRecordBloodTransfusionDetail\Models\BloodTransfusionDetail;
use Tests\TestCase;

class BloodTransfusionDetailControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_blood_transfusion_detail(): void
    {
        $this->actingUser();
        $transfusion = BloodTransfusion::factory()->create();

        $response = $this->postJson('/api/v1/blood-transfusion-details', [
            'transfusion_id' => $transfusion->id,
            'blood_bag_number' => 'BAG-12345',
            'blood_type' => 'O+',
            'volume_ml' => 350,
            'start_time' => '2026-08-13 10:00:00',
            'end_time' => '2026-08-13 12:00:00',
            'status' => 'Completed',
        ]);

        $response->assertCreated()->assertJsonPath('data.blood_bag_number', 'BAG-12345');
        $this->assertDatabaseHas('blood_transfusion_details', ['blood_bag_number' => 'BAG-12345']);
    }

    public function test_it_lists_blood_transfusion_details(): void
    {
        $this->actingUser();
        $detail = BloodTransfusionDetail::factory()->create();

        $response = $this->getJson('/api/v1/blood-transfusion-details');

        $response->assertOk()->assertJsonCount(1, 'data');
        $this->assertEquals($detail->id, $response->json('data.0.id'));
    }

    public function test_it_shows_a_blood_transfusion_detail(): void
    {
        $this->actingUser();
        $detail = BloodTransfusionDetail::factory()->create();

        $response = $this->getJson("/api/v1/blood-transfusion-details/{$detail->id}");

        $response->assertOk()->assertJsonPath('data.id', $detail->id);
    }

    public function test_it_updates_a_blood_transfusion_detail(): void
    {
        $this->actingUser();
        $detail = BloodTransfusionDetail::factory()->create();

        $response = $this->putJson("/api/v1/blood-transfusion-details/{$detail->id}", [
            'transfusion_id' => $detail->transfusion_id,
            'blood_bag_number' => $detail->blood_bag_number,
            'volume_ml' => 400,
            'reaction_observed' => 'Mild itching',
        ]);

        $response->assertOk()->assertJsonPath('data.reaction_observed', 'Mild itching');
    }

    public function test_it_deletes_a_blood_transfusion_detail(): void
    {
        $this->actingUser();
        $detail = BloodTransfusionDetail::factory()->create();

        $response = $this->deleteJson("/api/v1/blood-transfusion-details/{$detail->id}");

        $response->assertOk();
        $this->assertDatabaseMissing('blood_transfusion_details', ['id' => $detail->id]);
    }
}
