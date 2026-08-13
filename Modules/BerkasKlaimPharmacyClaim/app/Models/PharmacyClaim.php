<?php

namespace Modules\BerkasKlaimPharmacyClaim\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\BerkasKlaimClaimFile\Models\ClaimFile;
use Modules\BerkasKlaimPharmacyClaim\Database\Factories\PharmacyClaimFactory;
use Modules\LayananPrescription\Models\Prescription;

class PharmacyClaim extends Model
{
    use HasFactory;

    protected $fillable = [
        'claim_file_id',
        'prescription_id',
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

    public function prescription(): BelongsTo
    {
        return $this->belongsTo(Prescription::class);
    }

    protected static function newFactory(): PharmacyClaimFactory
    {
        return PharmacyClaimFactory::new();
    }
}
