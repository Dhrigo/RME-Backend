<?php

namespace Modules\MedicalRecordBaepInsomniaDetail\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\MedicalRecordBaepInterventionProtocol\Models\BaepInterventionProtocol;
use Modules\MedicalRecordBaepInsomniaDetail\Database\Factories\BaepInsomniaDetailFactory;

class BaepInsomniaDetail extends Model
{
    use HasFactory;

    protected $table = 'baep_insomnia_details';

    protected $fillable = [
        'baep_protocol_id',
        'scale_used',
        'score',
        'sleep_onset_latency_minutes',
        'sleep_efficiency_percent',
    ];

    public function baepProtocol(): BelongsTo
    {
        return $this->belongsTo(BaepInterventionProtocol::class, 'baep_protocol_id');
    }

    protected static function newFactory(): BaepInsomniaDetailFactory
    {
        return BaepInsomniaDetailFactory::new();
    }
}
