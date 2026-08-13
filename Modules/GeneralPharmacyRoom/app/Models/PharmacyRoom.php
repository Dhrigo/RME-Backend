<?php

namespace Modules\GeneralPharmacyRoom\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralPharmacyRoom\Database\Factories\PharmacyRoomFactory;
use Modules\GeneralWard\Models\Ward;

class PharmacyRoom extends Model
{
    use HasFactory;

    protected $fillable = ['ward_id', 'pharmacy_type', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class);
    }

    protected static function newFactory(): PharmacyRoomFactory
    {
        return PharmacyRoomFactory::new();
    }
}
