<?php

namespace Modules\LayananTreatmentProtocolStep\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\LayananTreatmentProtocol\Models\TreatmentProtocol;
use Modules\LayananTreatmentProtocolStep\Database\Factories\TreatmentProtocolStepFactory;

class TreatmentProtocolStep extends Model
{
    use HasFactory;

    protected $fillable = [
        'treatment_protocol_id',
        'sequence',
        'instruction',
        'scheduled_at',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'scheduled_at' => 'datetime',
        ];
    }

    public function treatmentProtocol(): BelongsTo
    {
        return $this->belongsTo(\Modules\LayananTreatmentProtocol\Models\TreatmentProtocol::class);
    }

    protected static function newFactory(): TreatmentProtocolStepFactory
    {
        return TreatmentProtocolStepFactory::new();
    }
}
