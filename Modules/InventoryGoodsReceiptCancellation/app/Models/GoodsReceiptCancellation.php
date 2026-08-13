<?php

namespace Modules\InventoryGoodsReceiptCancellation\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\InventoryGoodsReceipt\Models\GoodsReceipt;
use Modules\InventoryGoodsReceiptCancellation\Database\Factories\GoodsReceiptCancellationFactory;

class GoodsReceiptCancellation extends Model
{
    use HasFactory;

    protected $fillable = [
        'cancellation_number',
        'goods_receipt_id',
        'reason',
        'cancelled_by',
        'cancelled_at',
    ];

    protected function casts(): array
    {
        return [
            'cancelled_at' => 'datetime',
        ];
    }

    public function goodsReceipt(): BelongsTo
    {
        return $this->belongsTo(GoodsReceipt::class);
    }

    public function cancelledBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cancelled_by');
    }

    /**
     * Format: GRC-{year}-{6-digit sequential per year}. Same known limitation as
     * Patient::generateMedicalRecordNumber() - not concurrency-safe.
     */
    public static function generateCancellationNumber(): string
    {
        $year = now()->format('Y');
        $count = static::query()->where('cancellation_number', 'like', "GRC-{$year}-%")->count();

        return sprintf('GRC-%s-%06d', $year, $count + 1);
    }

    protected static function newFactory(): GoodsReceiptCancellationFactory
    {
        return GoodsReceiptCancellationFactory::new();
    }
}
