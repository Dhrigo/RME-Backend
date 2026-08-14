<?php

namespace Modules\Sitb\Console\Commands;

use Illuminate\Console\Command;
use Modules\Sitb\Services\SitbService;

class RetrySitbSubmissions extends Command
{
    protected $signature = 'sitb:retry-submissions';

    protected $description = 'Send any pasien_tb rows still queued (kirim = 1) to SITB';

    public function handle(SitbService $service): int
    {
        $service->kirimSemuaAntrian();

        $this->info('SITB retry pass complete.');

        return self::SUCCESS;
    }
}
