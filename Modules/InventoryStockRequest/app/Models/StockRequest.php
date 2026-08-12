<?php

namespace Modules\InventoryStockRequest\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\GeneralWard\Models\Ward;
use Modules\InventoryItem\Models\Item;
use Modules\InventoryStockRequest\Database\Factories\StockRequestFactory;

class StockRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_number',
        'ward_id',
        'item_id',
        'quantity',
        'requested_by',
        'requested_at',
        'fulfilled_at',
        'notes',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'requested_at' => 'datetime',
            'fulfilled_at' => 'datetime',
        ];
    }

    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class);
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function requestedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    /**
     * Format: REQ-{year}-{6-digit sequential per year}. Same known limitation as
     * Patient::generateMedicalRecordNumber() - not concurrency-safe.
     */
    public static function generateRequestNumber(): string
    {
        $year = now()->format('Y');
        $count = static::query()->where('request_number', 'like', "REQ-{$year}-%")->count();

        return sprintf('REQ-%s-%06d', $year, $count + 1);
    }

    protected static function newFactory(): StockRequestFactory
    {
        return StockRequestFactory::new();
    }
}
