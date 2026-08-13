<?php

namespace Modules\InventoryItemClassification\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\InventoryItemClassification\Database\Factories\ItemClassificationFactory;

class ItemClassification extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    protected static function newFactory(): ItemClassificationFactory
    {
        return ItemClassificationFactory::new();
    }
}
