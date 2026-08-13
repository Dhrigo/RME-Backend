<?php

namespace Modules\BerkasKlaimClinicalLabClaimItem\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\BerkasKlaimClinicalLabClaim\Models\ClinicalLabClaim;
use Modules\BerkasKlaimClinicalLabClaimItem\Database\Factories\ClinicalLabClaimItemFactory;

class ClinicalLabClaimItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'clinical_lab_claim_id',
        'test_name',
        'amount',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
        ];
    }

    public function clinicalLabClaim(): BelongsTo
    {
        return $this->belongsTo(ClinicalLabClaim::class);
    }

    protected static function newFactory(): ClinicalLabClaimItemFactory
    {
        return ClinicalLabClaimItemFactory::new();
    }
}
