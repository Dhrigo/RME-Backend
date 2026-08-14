<?php

namespace Modules\SatuSehat\Console\Commands;

use Illuminate\Console\Command;
use Modules\SatuSehat\Models\SatuSehatStagingSubmission;
use Modules\SatuSehat\Services\SatuSehatClient;

class RetrySatuSehatSubmissions extends Command
{
    protected $signature = 'satusehat:retry-submissions';

    protected $description = 'Retry any staged SATUSEHAT FHIR submissions still pending or failed';

    public function handle(SatuSehatClient $client): int
    {
        $submissions = SatuSehatStagingSubmission::whereIn('status', ['pending', 'failed'])->get();

        foreach ($submissions as $submission) {
            $client->send($submission);
        }

        $this->info("Retried {$submissions->count()} staged submission(s).");

        return self::SUCCESS;
    }
}
