<?php

namespace Modules\PembayaranDiscount\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\PembayaranDiscount\Database\Factories\DiscountFactory;

class Discount extends Model
{
    use HasFactory;

    public const DISCOUNT_TYPES = ['percentage', 'fixed'];

    protected $fillable = [
        'code',
        'name',
        'discount_type',
        'value',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'value' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    protected static function newFactory(): DiscountFactory
    {
        return DiscountFactory::new();
    }
}
