<?php

namespace Modules\GeneralPackage\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralPackage\Database\Factories\PackageFactory;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'price',
        'description',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    protected static function newFactory(): PackageFactory
    {
        return PackageFactory::new();
    }
}
