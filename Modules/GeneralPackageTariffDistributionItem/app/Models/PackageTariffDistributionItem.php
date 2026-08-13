<?php

namespace Modules\GeneralPackageTariffDistributionItem\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralPackageTariffDistribution\Models\PackageTariffDistribution;
use Modules\GeneralPackageTariffDistributionItem\Database\Factories\PackageTariffDistributionItemFactory;

class PackageTariffDistributionItem extends Model
{
    use HasFactory;

    public const RECIPIENT_TYPES = ['dokter', 'perawat', 'rumah_sakit', 'farmasi'];

    protected $fillable = [
        'package_tariff_distribution_id',
        'recipient_type',
        'recipient_id',
        'percentage',
        'amount',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'percentage' => 'decimal:2',
            'amount' => 'decimal:2',
        ];
    }

    public function distribution(): BelongsTo
    {
        return $this->belongsTo(PackageTariffDistribution::class, 'package_tariff_distribution_id');
    }

    protected static function newFactory(): PackageTariffDistributionItemFactory
    {
        return PackageTariffDistributionItemFactory::new();
    }
}
