<?php

namespace Modules\PendaftaranVisitDateChange\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\PendaftaranVisitDateChange\Database\Factories\VisitDateChangeFactory;

class VisitDateChange extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'old_date',
        'new_date',
        'changed_by',
        'reason',
    ];

    protected function casts(): array
    {
        return [
            'old_date' => 'date',
            'new_date' => 'date',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }

    public function changedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'changed_by');
    }

    protected static function newFactory(): VisitDateChangeFactory
    {
        return VisitDateChangeFactory::new();
    }
}
