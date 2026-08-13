<?php

namespace Modules\GeneralEmployeePhoto\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralEmployeePhoto\Models\EmployeePhoto;
use Tests\TestCase;

class GeneralEmployeePhotoControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_creates_employee_photo(): void
    {
        $this->actingUser();
        $employee = Employee::factory()->create();

        $this->postJson('/api/v1/employee-photos', [
            'employee_id' => $employee->id,
            'file_path' => 'employee-photos/001.jpg',
            'taken_at' => now()->toIso8601String(),
        ])
            ->assertCreated()
            ->assertJsonPath('file_path', 'employee-photos/001.jpg');
    }

    public function test_it_lists_photos_filtered_by_employee(): void
    {
        $this->actingUser();
        $employee = Employee::factory()->create();
        EmployeePhoto::factory()->count(2)->create(['employee_id' => $employee->id]);
        EmployeePhoto::factory()->create();

        $this->getJson("/api/v1/employee-photos?employee_id={$employee->id}")
            ->assertOk()
            ->assertJsonCount(2, 'data');
    }

    public function test_it_validates_store_request(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/employee-photos', [])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['employee_id', 'file_path', 'taken_at']);
    }

    public function test_it_updates_employee_photo(): void
    {
        $this->actingUser();
        $photo = EmployeePhoto::factory()->create(['file_path' => 'employee-photos/old.jpg']);

        $this->putJson("/api/v1/employee-photos/{$photo->id}", ['file_path' => 'employee-photos/new.jpg'])
            ->assertOk()
            ->assertJsonPath('file_path', 'employee-photos/new.jpg');
    }

    public function test_it_deletes_employee_photo(): void
    {
        $this->actingUser();
        $photo = EmployeePhoto::factory()->create();

        $this->deleteJson("/api/v1/employee-photos/{$photo->id}")
            ->assertNoContent();

        $this->assertDatabaseMissing('employee_photos', ['id' => $photo->id]);
    }
}
