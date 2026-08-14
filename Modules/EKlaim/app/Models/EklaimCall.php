<?php

namespace Modules\EKlaim\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\EKlaim\Database\Factories\EklaimCallFactory;

/**
 * Audit ledger of every ws.php RPC call made through this module - useful
 * given ws.php is a single endpoint dispatched by `metadata.method` with no
 * per-operation local table of its own (mirrors the read-mostly pass-through
 * ledgers used for Sisrute/RsOnline where per-endpoint body schemas aren't
 * independently verified).
 */
class EklaimCall extends Model
{
    use HasFactory;

    protected $fillable = [
        'method',
        'request_data',
        'response_data',
        'status',
        'error_message',
    ];

    protected function casts(): array
    {
        return [
            'request_data' => 'array',
            'response_data' => 'array',
        ];
    }

    protected static function newFactory(): EklaimCallFactory
    {
        return EklaimCallFactory::new();
    }
}
