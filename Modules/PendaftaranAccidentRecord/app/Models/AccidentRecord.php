<?php

namespace Modules\PendaftaranAccidentRecord\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\PendaftaranAccidentRecord\Database\Factories\AccidentRecordFactory;
use Modules\PendaftaranVisit\Models\Visit;

class AccidentRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'accident_type',
        'accident_at',
        'location',
        'police_report_number',
    ];

    protected function casts(): array
    {
        return [
            'accident_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }

    protected static function newFactory(): AccidentRecordFactory
    {
        return AccidentRecordFactory::new();
    }
}
