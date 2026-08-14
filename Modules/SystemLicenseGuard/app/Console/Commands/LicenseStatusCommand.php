<?php

namespace Modules\SystemLicenseGuard\Console\Commands;

use Illuminate\Console\Command;
use Modules\SystemLicenseGuard\Services\HardwareFingerprintService;
use Modules\SystemLicenseGuard\Services\LicenseVerifierService;

class LicenseStatusCommand extends Command
{
    protected $signature = 'license:status';
    protected $description = 'Display the current system license status and hardware fingerprint';

    public function handle(LicenseVerifierService $verifier, HardwareFingerprintService $fingerprintService): int
    {
        $hwid = $fingerprintService->getFingerprint();
        $this->info("==================================================");
        $this->info(" SIM-GOS System License Guard Status Diagnostic   ");
        $this->info("==================================================");
        $this->line("Hardware Fingerprint (HWID) : <fg=yellow>{$hwid}</>");
        $this->line("Hostname                   : " . gethostname());
        $this->line("OS Platform                : " . PHP_OS_FAMILY);
        $this->line("PHP Version                : " . PHP_VERSION);
        $this->line("--------------------------------------------------");

        $verification = $verifier->verify();
        $license = $verification['license'];

        if (!$license) {
            $this->error("Status: [UNLICENSED] - No active license installed.");
            $this->warn("Provide the HWID above to your SaaS administrator to generate an activation token.");
            return 1;
        }

        if ($verification['valid']) {
            $this->info("Status: [ACTIVE] Valid and Authenticated");
        } else {
            $this->error("Status: [{$verification['code']}] {$verification['message']}");
        }

        $this->table(
            ['Property', 'Value'],
            [
                ['Instance ID', $license->instance_id],
                ['Client Name', $license->client_name],
                ['Client Code', $license->client_code],
                ['Tier / Plan', strtoupper($license->tier)],
                ['Issued At', $license->issued_at?->format('Y-m-d H:i:s') ?? '-'],
                ['Valid Until', $license->valid_until?->format('Y-m-d H:i:s') ?? '-'],
                ['Days Left', max(0, (int) now()->diffInDays($license->valid_until, false))],
                ['Allowed Modules', implode(', ', $license->allowed_modules ?? [])],
                ['Last Synced At', $license->last_synced_at?->format('Y-m-d H:i:s') ?? 'Never'],
            ]
        );

        return $verification['valid'] ? 0 : 1;
    }
}
