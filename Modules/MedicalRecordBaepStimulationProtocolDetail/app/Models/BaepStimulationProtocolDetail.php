<?php

namespace Modules\MedicalRecordBaepStimulationProtocolDetail\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\MedicalRecordBaepInterventionProtocol\Models\BaepInterventionProtocol;
use Modules\MedicalRecordBaepStimulationProtocolDetail\Database\Factories\BaepStimulationProtocolDetailFactory;

class BaepStimulationProtocolDetail extends Model
{
    use HasFactory;

    protected $table = 'baep_stimulation_protocol_details';

    protected $fillable = [
        'baep_protocol_id',
        'stimulation_site',
        'stimulation_frequency_hz',
        'stimulation_duration_minutes',
        'intensity_ma',
        'number_of_sessions',
    ];

    protected function casts(): array
    {
        return [
            'stimulation_frequency_hz' => 'decimal:2',
            'intensity_ma' => 'decimal:2',
        ];
    }

    public function baepProtocol(): BelongsTo
    {
        return $this->belongsTo(BaepInterventionProtocol::class, 'baep_protocol_id');
    }

    protected static function newFactory(): BaepStimulationProtocolDetailFactory
    {
        return BaepStimulationProtocolDetailFactory::new();
    }
}
