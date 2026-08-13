<?php

namespace Modules\GeneralGuarantorWardAccess\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralGuarantorWardAccess\Database\Factories\GuarantorWardAccessFactory;
use Modules\GeneralWard\Models\Ward;
use Modules\PendaftaranGuarantor\Models\Guarantor;

class GuarantorWardAccess extends Model
{
    use HasFactory;

    protected $fillable = [
        'guarantor_id',
        'ward_id',
        'is_allowed',
        'notes',
    ];

    protected function casts(): array
    {
        return ['is_allowed' => 'boolean'];
    }

    public function guarantor(): BelongsTo
    {
        return $this->belongsTo(Guarantor::class);
    }

    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class);
    }

    protected static function newFactory(): GuarantorWardAccessFactory
    {
        return GuarantorWardAccessFactory::new();
    }
}
