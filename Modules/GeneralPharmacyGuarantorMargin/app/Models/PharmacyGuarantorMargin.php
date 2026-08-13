<?php

namespace Modules\GeneralPharmacyGuarantorMargin\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralPharmacyGuarantorMargin\Database\Factories\PharmacyGuarantorMarginFactory;
use Modules\PendaftaranGuarantor\Models\Guarantor;

class PharmacyGuarantorMargin extends Model
{
    use HasFactory;

    protected $fillable = [
        'guarantor_id',
        'margin_percentage',
        'effective_date',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'margin_percentage' => 'decimal:2',
            'effective_date' => 'date',
            'is_active' => 'boolean',
        ];
    }

    public function guarantor(): BelongsTo
    {
        return $this->belongsTo(Guarantor::class);
    }

    protected static function newFactory(): PharmacyGuarantorMarginFactory
    {
        return PharmacyGuarantorMarginFactory::new();
    }
}
