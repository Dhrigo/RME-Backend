<?php

namespace Modules\BerkasKlaimRadiologyClaimItem\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\BerkasKlaimRadiologyClaim\Models\RadiologyClaim;
use Modules\BerkasKlaimRadiologyClaimItem\Database\Factories\RadiologyClaimItemFactory;

class RadiologyClaimItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'radiology_claim_id',
        'exam_name',
        'amount',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
        ];
    }

    public function radiologyClaim(): BelongsTo
    {
        return $this->belongsTo(RadiologyClaim::class);
    }

    protected static function newFactory(): RadiologyClaimItemFactory
    {
        return RadiologyClaimItemFactory::new();
    }
}
