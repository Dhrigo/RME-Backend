<?php

namespace Modules\SystemLicenseGuard\Models;

use Illuminate\Database\Eloquent\Model;

class SystemLicenseAuditLog extends Model
{
    protected $table = 'system_license_audit_logs';

    protected $fillable = [
        'event_type',
        'details',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'details' => 'array',
    ];
}
