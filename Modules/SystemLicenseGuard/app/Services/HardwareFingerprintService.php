<?php

namespace Modules\SystemLicenseGuard\Services;

class HardwareFingerprintService
{
    protected ?string $cachedFingerprint = null;

    public function getFingerprint(): string
    {
        if ($this->cachedFingerprint !== null) {
            return $this->cachedFingerprint;
        }

        $components = [
            'cpu' => $this->getCpuIdentifier(),
            'mac' => $this->getMacAddress(),
            'machine_id' => $this->getMachineId(),
            'hostname' => gethostname() ?: 'simgos-node',
            'base_path' => hash('sha256', base_path()),
        ];

        $rawFingerprint = hash('sha256', json_encode($components));
        
        $shortHash = strtoupper(substr($rawFingerprint, 0, 16));
        $formatted = 'HWID-' . implode('-', str_split($shortHash, 4));

        $this->cachedFingerprint = $formatted;
        return $formatted;
    }

    protected function getCpuIdentifier(): string
    {
        if (PHP_OS_FAMILY === 'Windows') {
            try {
                $output = @shell_exec('wmic cpu get processorid 2>nul');
                if ($output) {
                    $lines = array_filter(array_map('trim', explode("\n", $output)));
                    if (count($lines) > 1) {
                        return end($lines);
                    }
                }
            } catch (\Throwable) {}
        } elseif (PHP_OS_FAMILY === 'Linux') {
            try {
                if (file_exists('/proc/cpuinfo')) {
                    $cpuinfo = file_get_contents('/proc/cpuinfo');
                    if (preg_match('/Serial\s*:\s*([a-f0-9]+)/i', $cpuinfo, $matches)) {
                        return $matches[1];
                    }
                }
            } catch (\Throwable) {}
        }

        return php_uname('m') . '-' . php_uname('r');
    }

    protected function getMacAddress(): string
    {
        if (PHP_OS_FAMILY === 'Windows') {
            try {
                $output = @shell_exec('getmac 2>nul');
                if ($output && preg_match('/([0-9A-F]{2}[:-]){5}([0-9A-F]{2})/i', $output, $matches)) {
                    return strtoupper(str_replace('-', ':', $matches[0]));
                }
            } catch (\Throwable) {}
        } elseif (PHP_OS_FAMILY === 'Linux') {
            try {
                $output = @shell_exec('ip link 2>/dev/null || ifconfig 2>/dev/null');
                if ($output && preg_match('/([0-9a-f]{2}[:-]){5}([0-9a-f]{2})/i', $output, $matches)) {
                    return strtoupper(str_replace('-', ':', $matches[0]));
                }
            } catch (\Throwable) {}
        }

        return '00:00:00:00:00:00';
    }

    protected function getMachineId(): string
    {
        if (PHP_OS_FAMILY === 'Windows') {
            try {
                $output = @shell_exec('wmic csproduct get uuid 2>nul');
                if ($output) {
                    $lines = array_filter(array_map('trim', explode("\n", $output)));
                    if (count($lines) > 1) {
                        return end($lines);
                    }
                }
            } catch (\Throwable) {}
        } elseif (PHP_OS_FAMILY === 'Linux') {
            try {
                if (file_exists('/etc/machine-id')) {
                    return trim(file_get_contents('/etc/machine-id'));
                }
                if (file_exists('/var/lib/dbus/machine-id')) {
                    return trim(file_get_contents('/var/lib/dbus/machine-id'));
                }
                if (file_exists('/sys/class/dmi/id/product_uuid')) {
                    return trim(file_get_contents('/sys/class/dmi/id/product_uuid'));
                }
            } catch (\Throwable) {}
        }

        return hash('sha256', php_uname());
    }

    public function matches(string $expectedHwid): bool
    {
        if ($expectedHwid === '*' || $expectedHwid === 'ANY') {
            return true;
        }

        return hash_equals($this->getFingerprint(), $expectedHwid);
    }
}
