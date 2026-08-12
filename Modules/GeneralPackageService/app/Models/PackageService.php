<?php

namespace Modules\GeneralPackageService\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralPackageService\Database\Factories\PackageServiceFactory;

class PackageService extends Model
{
    use HasFactory;

    protected $fillable = ['package_id', 'service_id', 'quantity', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    protected static function newFactory(): PackageServiceFactory
    {
        return PackageServiceFactory::new();
    }
}
