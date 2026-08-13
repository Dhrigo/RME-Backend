<?php

namespace Modules\LayananOxygenUsage\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Modules\Auth\Models\User;
use \Modules\PendaftaranVisit\Models\Visit;
use Modules\LayananOxygenUsage\Database\Factories\OxygenUsageFactory;

class OxygenUsage extends Model
{
    use HasFactory;

    protected $table = 'oxygen_usages';

    protected $fillable = [
        'visit_id',
        'flow_rate_lpm',
        'method',
        'started_at',
        'ended_at',
        'recorded_by',
    ];

    protected function casts(): array
    {
        return [
            'flow_rate_lpm' => 'decimal:1',
            'started_at' => 'datetime',
            'ended_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }

    public function recordedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }

    protected static function newFactory(): OxygenUsageFactory
    {
        return OxygenUsageFactory::new();
    }
}
