<?php

namespace Modules\PembatalanVisitCancellation\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Modules\Auth\Models\User;
use \Modules\PendaftaranVisit\Models\Visit;
use Modules\PembatalanVisitCancellation\Database\Factories\VisitCancellationFactory;

class VisitCancellation extends Model
{
    use HasFactory;

    protected $table = 'pembatalan_visit_cancellations';

    protected $fillable = [
        'visit_id',
        'cancelled_by',
        'reason',
        'cancelled_at',
    ];

    protected function casts(): array
    {
        return [
            'cancelled_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class, 'visit_id');
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
