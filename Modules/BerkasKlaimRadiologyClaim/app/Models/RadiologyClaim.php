<?php

namespace Modules\BerkasKlaimRadiologyClaim\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\BerkasKlaimClaimFile\Models\ClaimFile;
use Modules\BerkasKlaimRadiologyClaim\Database\Factories\RadiologyClaimFactory;
use Modules\LayananLabOrder\Models\LabOrder;

/**
 * No dedicated radiology order module exists in this codebase yet (only
 * LayananLabOrder/LabOrder). order_id points at lab_orders as the closest
 * existing "order" concept per task brief fallback instruction.
 */
class RadiologyClaim extends Model
{
    use HasFactory;

    protected $fillable = [
        'claim_file_id',
        'order_id',
        'submitted_at',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'submitted_at' => 'datetime',
        ];
    }

    public function claimFile(): BelongsTo
    {
        return $this->belongsTo(ClaimFile::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(LabOrder::class, 'order_id');
    }

    protected static function newFactory(): RadiologyClaimFactory
    {
        return RadiologyClaimFactory::new();
    }
}
