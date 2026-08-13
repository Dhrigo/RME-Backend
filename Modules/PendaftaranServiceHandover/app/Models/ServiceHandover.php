<?php

namespace Modules\PendaftaranServiceHandover\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralWard\Models\Ward;
use Modules\PendaftaranServiceHandover\Database\Factories\ServiceHandoverFactory;
use Modules\PendaftaranVisit\Models\Visit;

class ServiceHandover extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'ward_id',
        'handed_over_by',
        'received_by',
        'handed_over_at',
        'received_at',
        'notes',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'handed_over_at' => 'datetime',
            'received_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }

    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class);
    }

    public function handedOverBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'handed_over_by');
    }

    public function receivedBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'received_by');
    }

    protected static function newFactory(): ServiceHandoverFactory
    {
        return ServiceHandoverFactory::new();
    }
}
