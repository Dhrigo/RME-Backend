<?php

namespace Modules\GeneralWardTransferRoute\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Modules\GeneralWard\Models\Ward;
use Modules\GeneralWardTransferRoute\Database\Factories\WardTransferRouteFactory;

class WardTransferRoute extends Model
{
    use HasFactory;

    protected $table = 'ward_transfer_routes';

    protected $fillable = [
        'from_ward_id',
        'to_ward_id',
        'requires_approval',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'requires_approval' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function fromWard(): BelongsTo
    {
        return $this->belongsTo(Ward::class, 'from_ward_id');
    }

    public function toWard(): BelongsTo
    {
        return $this->belongsTo(Ward::class, 'to_ward_id');
    }

    protected static function newFactory(): WardTransferRouteFactory
    {
        return WardTransferRouteFactory::new();
    }
}
