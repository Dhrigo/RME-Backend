<?php

namespace Modules\PendaftaranWardQueue\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralWard\Models\Ward;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\PendaftaranWardQueue\Database\Factories\WardQueueFactory;

class WardQueue extends Model
{
    use HasFactory;

    protected $fillable = [
        'ward_id',
        'queue_number',
        'visit_id',
        'called_at',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'called_at' => 'datetime',
        ];
    }

    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class);
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }

    protected static function newFactory(): WardQueueFactory
    {
        return WardQueueFactory::new();
    }
}
