<?php

namespace Modules\PegawaiEmployeeContact\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PegawaiEmployeeContact\Models\EmployeeContact;
use Tests\TestCase;

class EmployeeContactControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_records_an_employee_contact(): void
    {
        $this->actingUser();
        $employee = Employee::factory()->create();

        $response = $this->postJson('/api/v1/employee-contacts', [
            'employee_id' => $employee->id,
            'contact_type' => 'telepon_seluler',
            'value' => '081234567890',
        ]);

        $response->assertCreated();
        $response->assertJsonPath('data.contact_type', 'telepon_seluler');
    }

    public function test_it_rejects_invalid_contact_type(): void
    {
        $this->actingUser();
        $employee = Employee::factory()->create();

        $response = $this->postJson('/api/v1/employee-contacts', [
            'employee_id' => $employee->id,
            'contact_type' => 'fax',
            'value' => '081234567890',
        ]);

        $response->assertStatus(422);
    }

    public function test_it_lists_contacts_filtered_by_employee(): void
    {
        $this->actingUser();
        $employee = Employee::factory()->create();
        EmployeeContact::factory()->count(2)->create(['employee_id' => $employee->id]);
        EmployeeContact::factory()->create();

        $response = $this->getJson("/api/v1/employee-contacts?employee_id={$employee->id}");

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_updates_a_contact(): void
    {
        $this->actingUser();
        $contact = EmployeeContact::factory()->create(['contact_type' => 'telepon_seluler']);

        $response = $this->putJson("/api/v1/employee-contacts/{$contact->id}", ['contact_type' => 'email', 'value' => 'a@b.com']);

        $response->assertOk()->assertJsonPath('data.contact_type', 'email');
    }

    public function test_it_deletes_a_contact(): void
    {
        $this->actingUser();
        $contact = EmployeeContact::factory()->create();

        $this->deleteJson("/api/v1/employee-contacts/{$contact->id}")->assertNoContent();
        $this->assertDatabaseMissing('employee_contacts', ['id' => $contact->id]);
    }

    public function test_guest_cannot_access_employee_contacts(): void
    {
        $this->getJson('/api/v1/employee-contacts')->assertStatus(401);
    }
}
