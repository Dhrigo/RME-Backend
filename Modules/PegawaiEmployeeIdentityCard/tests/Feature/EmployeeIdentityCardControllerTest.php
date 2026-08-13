<?php

namespace Modules\PegawaiEmployeeIdentityCard\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PegawaiEmployeeIdentityCard\Models\EmployeeIdentityCard;
use Tests\TestCase;

class EmployeeIdentityCardControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_records_an_employee_identity_card(): void
    {
        $this->actingUser();
        $employee = Employee::factory()->create();

        $response = $this->postJson('/api/v1/employee-identity-cards', [
            'employee_id' => $employee->id,
            'id_type' => 'KTP',
            'id_number' => '3201234567890001',
            'issued_at' => '2020-01-10',
        ]);

        $response->assertCreated();
        $response->assertJsonPath('data.id_type', 'KTP');
        $response->assertJsonPath('data.id_number', '3201234567890001');
    }

    public function test_it_rejects_invalid_id_type(): void
    {
        $this->actingUser();
        $employee = Employee::factory()->create();

        $response = $this->postJson('/api/v1/employee-identity-cards', [
            'employee_id' => $employee->id,
            'id_type' => 'NPWP',
            'id_number' => '3201234567890001',
        ]);

        $response->assertStatus(422);
    }

    public function test_it_lists_cards_filtered_by_employee(): void
    {
        $this->actingUser();
        $employee = Employee::factory()->create();
        EmployeeIdentityCard::factory()->count(2)->create(['employee_id' => $employee->id]);
        EmployeeIdentityCard::factory()->create();

        $response = $this->getJson("/api/v1/employee-identity-cards?employee_id={$employee->id}");

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_updates_a_card(): void
    {
        $this->actingUser();
        $card = EmployeeIdentityCard::factory()->create(['id_type' => 'KTP']);

        $response = $this->putJson("/api/v1/employee-identity-cards/{$card->id}", ['id_type' => 'SIM']);

        $response->assertOk()->assertJsonPath('data.id_type', 'SIM');
    }

    public function test_it_deletes_a_card(): void
    {
        $this->actingUser();
        $card = EmployeeIdentityCard::factory()->create();

        $this->deleteJson("/api/v1/employee-identity-cards/{$card->id}")->assertNoContent();
        $this->assertDatabaseMissing('employee_identity_cards', ['id' => $card->id]);
    }

    public function test_guest_cannot_access_employee_identity_cards(): void
    {
        $this->getJson('/api/v1/employee-identity-cards')->assertStatus(401);
    }
}
