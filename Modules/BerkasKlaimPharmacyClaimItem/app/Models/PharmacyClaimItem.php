<?php

namespace Modules\BerkasKlaimPharmacyClaimItem\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\BerkasKlaimPharmacyClaim\Models\PharmacyClaim;
use Modules\BerkasKlaimPharmacyClaimItem\Database\Factories\PharmacyClaimItemFactory;

class PharmacyClaimItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'pharmacy_claim_id',
        'drug_name',
        'quantity',
        'unit_price',
        'amount',
    ];

    protected function casts(): array
    {
        return [
            'unit_price' => 'decimal:2',
            'amount' => 'decimal:2',
        ];
    }

    public function pharmacyClaim(): BelongsTo
    {
        return $this->belongsTo(PharmacyClaim::class);
    }

    protected static function newFactory(): PharmacyClaimItemFactory
    {
        return PharmacyClaimItemFactory::new();
    }
}
