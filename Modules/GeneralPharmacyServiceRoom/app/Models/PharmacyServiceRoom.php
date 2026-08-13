<?php

namespace Modules\GeneralPharmacyServiceRoom\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralPharmacyServiceRoom\Database\Factories\PharmacyServiceRoomFactory;
use Modules\GeneralWard\Models\Ward;

class PharmacyServiceRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'ward_id',
        'service_type',
        'is_active',
    ];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class);
    }

    protected static function newFactory(): PharmacyServiceRoomFactory
    {
        return PharmacyServiceRoomFactory::new();
    }
}
