<?php

namespace Modules\InventoryGoodsReturn\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\InventoryGoodsReturn\Database\Factories\GoodsReturnFactory;
use Modules\InventorySupplier\Models\Supplier;

class GoodsReturn extends Model
{
    use HasFactory;

    protected $fillable = [
        'return_number',
        'supplier_id',
        'returned_by',
        'returned_at',
        'reason',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'returned_at' => 'datetime',
        ];
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function returnedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'returned_by');
    }

    /**
     * Format: RTN-{year}-{6-digit sequential per year}. Same known limitation as
     * Patient::generateMedicalRecordNumber() - not concurrency-safe.
     */
    public static function generateReturnNumber(): string
    {
        $year = now()->format('Y');
        $count = static::query()->where('return_number', 'like', "RTN-{$year}-%")->count();

        return sprintf('RTN-%s-%06d', $year, $count + 1);
    }

    protected static function newFactory(): GoodsReturnFactory
    {
        return GoodsReturnFactory::new();
    }
}
