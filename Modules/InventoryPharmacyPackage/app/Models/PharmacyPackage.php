<?php

namespace Modules\InventoryPharmacyPackage\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralPharmacyServiceRoom\Models\PharmacyServiceRoom;
use Modules\InventoryPharmacyPackage\Database\Factories\PharmacyPackageFactory;

class PharmacyPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_code',
        'name',
        'pharmacy_service_room_id',
        'category',
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

    public function pharmacyServiceRoom(): BelongsTo
    {
        return $this->belongsTo(PharmacyServiceRoom::class);
    }

    protected static function newFactory(): PharmacyPackageFactory
    {
        return PharmacyPackageFactory::new();
    }
}
