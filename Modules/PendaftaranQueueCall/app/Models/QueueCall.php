<?php

namespace Modules\PendaftaranQueueCall\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\PendaftaranQueueCall\Database\Factories\QueueCallFactory;
use Modules\PendaftaranWardQueue\Models\WardQueue;

class QueueCall extends Model
{
    use HasFactory;

    protected $fillable = [
        'ward_queue_id',
        'called_at',
        'called_by',
        'counter',
    ];

    protected function casts(): array
    {
        return [
            'called_at' => 'datetime',
        ];
    }

    public function wardQueue(): BelongsTo
    {
        return $this->belongsTo(WardQueue::class);
    }

    public function calledBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'called_by');
    }

    protected static function newFactory(): QueueCallFactory
    {
        return QueueCallFactory::new();
    }
}
