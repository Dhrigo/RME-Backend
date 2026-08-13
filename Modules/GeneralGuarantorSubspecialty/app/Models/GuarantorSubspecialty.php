<?php

namespace Modules\GeneralGuarantorSubspecialty\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralGuarantorSubspecialty\Database\Factories\GuarantorSubspecialtyFactory;
use Modules\PendaftaranGuarantor\Models\Guarantor;

class GuarantorSubspecialty extends Model
{
    use HasFactory;

    protected $fillable = [
        'guarantor_id',
        'subspecialty_name',
        'is_covered',
        'coverage_note',
    ];

    protected function casts(): array
    {
        return ['is_covered' => 'boolean'];
    }

    public function guarantor(): BelongsTo
    {
        return $this->belongsTo(Guarantor::class);
    }

    protected static function newFactory(): GuarantorSubspecialtyFactory
    {
        return GuarantorSubspecialtyFactory::new();
    }
}
