<?php

namespace Modules\BerkasKlaimPathologyClaim\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\BerkasKlaimClaimFile\Models\ClaimFile;
use Modules\BerkasKlaimPathologyClaim\Database\Factories\PathologyClaimFactory;
use Modules\LayananLabOrder\Models\LabOrder;

/**
 * No dedicated anatomic-pathology order module exists in this codebase yet
 * (only LayananLabOrder/LabOrder). order_id points at lab_orders as the
 * closest existing "order" concept, same fallback used by
 * BerkasKlaimRadiologyClaim.
 */
class PathologyClaim extends Model
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

    protected static function newFactory(): PathologyClaimFactory
    {
        return PathologyClaimFactory::new();
    }
}
