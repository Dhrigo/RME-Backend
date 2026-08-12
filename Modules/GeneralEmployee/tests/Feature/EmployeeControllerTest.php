<?php

namespace Modules\GeneralEmployee\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Tests\TestCase;

class EmployeeControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_lists_employees(): void
    {
        $this->actingUser();
        Employee::factory()->count(3)->create();

        $response = $this->getJson('/api/v1/employees');

        $response->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_employee(): void
    {
        $this->actingUser();

        $response = $this->postJson('/api/v1/employees', [
            'name' => 'Budi Santoso',
            'employee_number' => '198501012010011001',
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('employees', ['name' => 'Budi Santoso']);
    }

    public function test_it_links_employee_to_a_user_account(): void
    {
        $this->actingUser();
        $account = User::factory()->create();

        $response = $this->postJson('/api/v1/employees', [
            'name' => 'Siti Aminah',
            'user_id' => $account->id,
        ]);

        $response->assertCreated()->assertJsonPath('data.user_id', $account->id);
    }

    public function test_it_updates_employee(): void
    {
        $this->actingUser();
        $employee = Employee::factory()->create();

        $response = $this->putJson("/api/v1/employees/{$employee->id}", ['name' => 'Nama Baru']);

        $response->assertOk()->assertJsonPath('data.name', 'Nama Baru');
    }

    public function test_it_deletes_employee(): void
    {
        $this->actingUser();
        $employee = Employee::factory()->create();

        $response = $this->deleteJson("/api/v1/employees/{$employee->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('employees', ['id' => $employee->id]);
    }

    public function test_guest_cannot_access_employees(): void
    {
        $this->getJson('/api/v1/employees')->assertStatus(401);
    }
}
