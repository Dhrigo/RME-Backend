<?php

namespace Modules\GeneralPackageItem\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralPackageItem\Database\Factories\PackageItemFactory;

class PackageItem extends Model
{
    use HasFactory;

    protected $fillable = ['package_id', 'item_id', 'quantity', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    protected static function newFactory(): PackageItemFactory
    {
        return PackageItemFactory::new();
    }
}
