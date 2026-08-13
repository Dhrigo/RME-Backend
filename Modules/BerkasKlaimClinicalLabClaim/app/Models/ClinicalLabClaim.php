<?php

namespace Modules\BerkasKlaimClinicalLabClaim\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\BerkasKlaimClaimFile\Models\ClaimFile;
use Modules\BerkasKlaimClinicalLabClaim\Database\Factories\ClinicalLabClaimFactory;
use Modules\LayananLabOrder\Models\LabOrder;

class ClinicalLabClaim extends Model
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

    protected static function newFactory(): ClinicalLabClaimFactory
    {
        return ClinicalLabClaimFactory::new();
    }
}
