<?php

namespace Modules\SystemLicenseGuard\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemLicense extends Model
{
    use HasFactory;

    protected $table = 'system_licenses';

    protected $fillable = [
        'instance_id',
        'client_name',
        'client_code',
        'license_key',
        'token_payload',
        'digital_signature',
        'hardware_id',
        'tier',
        'issued_at',
        'valid_until',
        'last_synced_at',
        'max_users',
        'allowed_modules',
        'integrity_hash',
        'status',
    ];

    protected $casts = [
        'issued_at' => 'datetime',
        'valid_until' => 'datetime',
        'last_synced_at' => 'datetime',
        'allowed_modules' => 'array',
        'max_users' => 'integer',
    ];

    public function computeIntegrityHash(string $hardwareId): string
    {
        $material = implode('|', [
            $this->instance_id,
            $this->client_code,
            $this->license_key,
            $this->hardware_id,
            $this->valid_until ? $this->valid_until->format('Y-m-d H:i:s') : '',
            $this->status,
            json_encode($this->allowed_modules ?? []),
        ]);

        $key = (string) (config('app.key') ?: 'simgos-license-salt') . $hardwareId;
        return hash_hmac('sha256', $material, $key);
    }

    public function verifyLocalIntegrity(string $hardwareId): bool
    {
        if (empty($this->integrity_hash)) {
            return false;
        }

        return hash_equals($this->computeIntegrityHash($hardwareId), $this->integrity_hash);
    }
}
