<?php

namespace Modules\GeneralRadiologyRoom\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralRadiologyRoom\Database\Factories\RadiologyRoomFactory;
use Modules\GeneralWard\Models\Ward;

class RadiologyRoom extends Model
{
    use HasFactory;

    protected $fillable = ['ward_id', 'radiology_type', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class);
    }

    protected static function newFactory(): RadiologyRoomFactory
    {
        return RadiologyRoomFactory::new();
    }
}
