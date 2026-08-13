<?php

namespace Modules\GeneralPackageTariffDistribution\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralPackage\Models\Package;
use Modules\GeneralPackageTariffDistribution\Database\Factories\PackageTariffDistributionFactory;

class PackageTariffDistribution extends Model
{
    use HasFactory;

    public const COMPONENTS = ['jasa_dokter', 'jasa_rs', 'jasa_perawat', 'bhp', 'obat'];

    protected $fillable = [
        'package_id',
        'component_name',
        'percentage',
        'amount',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'percentage' => 'decimal:2',
            'amount' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    protected static function newFactory(): PackageTariffDistributionFactory
    {
        return PackageTariffDistributionFactory::new();
    }
}
