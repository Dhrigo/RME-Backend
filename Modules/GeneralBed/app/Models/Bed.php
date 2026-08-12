<?php

namespace Modules\GeneralBed\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralBed\Database\Factories\BedFactory;
use Modules\GeneralRoom\Models\Room;

class Bed extends Model
{
    use HasFactory;

    protected $fillable = ['room_id', 'bed_number', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    protected static function newFactory(): BedFactory
    {
        return BedFactory::new();
    }
}
