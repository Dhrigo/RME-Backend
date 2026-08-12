<?php

namespace Modules\InventoryItem\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\InventoryItem\Database\Factories\ItemFactory;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'category',
        'unit',
        'brand',
        'is_generic',
        'is_formulary',
        'buy_price',
        'sell_price',
        'stock_quantity',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_generic' => 'boolean',
            'is_formulary' => 'boolean',
            'buy_price' => 'decimal:2',
            'sell_price' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    protected static function newFactory(): ItemFactory
    {
        return ItemFactory::new();
    }
}
