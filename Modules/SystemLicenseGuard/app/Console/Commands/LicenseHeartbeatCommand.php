<?php

namespace Modules\SystemLicenseGuard\Console\Commands;

use Illuminate\Console\Command;
use Modules\SystemLicenseGuard\Services\CentralHubClientService;

class LicenseHeartbeatCommand extends Command
{
    protected $signature = 'license:heartbeat';
    protected $description = 'Send telemetry and license validation heartbeat to Central SaaS Hub';

    public function handle(CentralHubClientService $hubClient): int
    {
        $this->info('Sending heartbeat to Central SaaS Hub...');
        $result = $hubClient->sendHeartbeat();

        if ($result['success']) {
            $this->info($result['message']);
            return 0;
        }

        $this->error($result['message']);
        return 1;
    }
}
