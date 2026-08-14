<?php

namespace Modules\SystemLicenseGuard\Models;

use Illuminate\Database\Eloquent\Model;

class SystemLicenseWatermark extends Model
{
    protected $table = 'system_license_watermarks';

    protected $fillable = [
        'highest_seen_timestamp',
        'recorded_at',
        'checksum',
    ];

    protected $casts = [
        'highest_seen_timestamp' => 'integer',
        'recorded_at' => 'datetime',
    ];

    public static function computeChecksum(int $timestamp): string
    {
        $key = (string) (config('app.key') ?: 'simgos-watermark-salt');
        return hash_hmac('sha256', (string) $timestamp, $key);
    }
}
