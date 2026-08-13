<?php

namespace Modules\PendaftaranVisitCancellation\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\PendaftaranVisitCancellation\Database\Factories\VisitCancellationFactory;

class VisitCancellation extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'cancelled_at',
        'cancelled_by',
        'reason',
    ];

    protected function casts(): array
    {
        return [
            'cancelled_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }

    public function cancelledBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cancelled_by');
    }

    protected static function newFactory(): VisitCancellationFactory
    {
        return VisitCancellationFactory::new();
    }
}
