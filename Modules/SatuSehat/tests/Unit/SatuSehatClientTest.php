<?php

namespace Modules\SatuSehat\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Modules\SatuSehat\Models\SatuSehatStagingSubmission;
use Modules\SatuSehat\Services\SatuSehatClient;
use Tests\TestCase;

class SatuSehatClientTest extends TestCase
{
    use RefreshDatabase;


    public function test_token_is_fetched_via_client_credentials_and_cached(): void
    {
        Http::fake([
            '*/accesstoken*' => Http::response(['access_token' => 'abc123', 'expires_in' => 3600]),
        ]);

        $client = app(SatuSehatClient::class);

        $this->assertSame('abc123', $client->token());
        $this->assertSame('abc123', $client->token());

        Http::assertSentCount(1);
    }

    public function test_submit_stages_then_marks_sent_on_success(): void
    {
        Http::fake([
            '*/accesstoken*' => Http::response(['access_token' => 'abc123', 'expires_in' => 3600]),
            '*/Encounter' => Http::response(['id' => 'satusehat-encounter-1']),
        ]);

        $client = app(SatuSehatClient::class);

        $submission = $client->submit('Encounter', ['resourceType' => 'Encounter'], 'Modules\\Pendaftaran\\Models\\Visit', 1);

        $this->assertSame('sent', $submission->status);
        $this->assertSame('satusehat-encounter-1', $submission->satusehat_id);
        $this->assertDatabaseHas('satu_sehat_staging_submissions', [
            'id' => $submission->id,
            'status' => 'sent',
        ]);
    }

    public function test_submit_marks_failed_and_keeps_row_when_request_fails(): void
    {
        Http::fake([
            '*/accesstoken*' => Http::response(['access_token' => 'abc123', 'expires_in' => 3600]),
            '*/Encounter' => Http::response(['issue' => 'invalid'], 400),
        ]);

        $client = app(SatuSehatClient::class);

        $submission = $client->submit('Encounter', ['resourceType' => 'Encounter'], 'Modules\\Pendaftaran\\Models\\Visit', 1);

        $this->assertSame('failed', $submission->status);
        $this->assertNotNull($submission->last_error);
    }
}
