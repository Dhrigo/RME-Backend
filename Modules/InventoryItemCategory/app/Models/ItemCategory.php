<?php

namespace Modules\InventoryItemCategory\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\InventoryItemCategory\Database\Factories\ItemCategoryFactory;

class ItemCategory extends Model
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

    protected static function newFactory(): ItemCategoryFactory
    {
        return ItemCategoryFactory::new();
    }
}
