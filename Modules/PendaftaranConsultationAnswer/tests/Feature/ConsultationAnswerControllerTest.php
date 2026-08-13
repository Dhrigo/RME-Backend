<?php

namespace Modules\PendaftaranConsultationAnswer\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranConsultation\Models\Consultation;
use Modules\PendaftaranConsultationAnswer\Models\ConsultationAnswer;
use Tests\TestCase;

class ConsultationAnswerControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_can_list_consultation_answers(): void
    {
        ConsultationAnswer::factory()->count(3)->create();

        $response = $this->actingAs($this->user)->getJson('/api/v1/consultationanswers');

        $response->assertOk()
            ->assertJsonCount(3, 'data');
    }

    public function test_can_create_consultation_answer(): void
    {
        $consultation = Consultation::factory()->create();
        $employee = Employee::factory()->create();

        $data = [
            'consultation_id' => $consultation->id,
            'answered_by' => $employee->id,
            'answered_at' => now()->toDateTimeString(),
            'answer' => 'Patient is clear for surgery',
        ];

        $response = $this->actingAs($this->user)->postJson('/api/v1/consultationanswers', $data);

        $response->assertCreated()
            ->assertJsonPath('data.answer', 'Patient is clear for surgery');

        $this->assertDatabaseHas('consultation_answers', $data);
    }

    public function test_can_show_consultation_answer(): void
    {
        $answer = ConsultationAnswer::factory()->create();

        $response = $this->actingAs($this->user)->getJson("/api/v1/consultationanswers/{$answer->id}");

        $response->assertOk()
            ->assertJsonPath('data.id', $answer->id);
    }
}
