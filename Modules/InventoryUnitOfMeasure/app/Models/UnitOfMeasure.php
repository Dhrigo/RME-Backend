<?php

namespace Modules\InventoryUnitOfMeasure\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\InventoryUnitOfMeasure\Database\Factories\UnitOfMeasureFactory;

class UnitOfMeasure extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'abbreviation',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    protected static function newFactory(): UnitOfMeasureFactory
    {
        return UnitOfMeasureFactory::new();
    }
}
