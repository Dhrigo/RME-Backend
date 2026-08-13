<?php

namespace Modules\BerkasKlaimPathologyClaimItem\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\BerkasKlaimPathologyClaim\Models\PathologyClaim;
use Modules\BerkasKlaimPathologyClaimItem\Database\Factories\PathologyClaimItemFactory;

class PathologyClaimItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'pathology_claim_id',
        'exam_name',
        'amount',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
        ];
    }

    public function pathologyClaim(): BelongsTo
    {
        return $this->belongsTo(PathologyClaim::class);
    }

    protected static function newFactory(): PathologyClaimItemFactory
    {
        return PathologyClaimItemFactory::new();
    }
}
