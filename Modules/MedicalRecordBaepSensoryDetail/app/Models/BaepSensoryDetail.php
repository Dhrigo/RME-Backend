<?php

namespace Modules\MedicalRecordBaepSensoryDetail\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\MedicalRecordBaepInterventionProtocol\Models\BaepInterventionProtocol;
use Modules\MedicalRecordBaepSensoryDetail\Database\Factories\BaepSensoryDetailFactory;

class BaepSensoryDetail extends Model
{
    use HasFactory;

    protected $table = 'baep_sensory_details';

    protected $fillable = [
        'baep_protocol_id',
        'sensory_modality',
        'sensory_score',
        'affected_region',
    ];

    public function baepProtocol(): BelongsTo
    {
        return $this->belongsTo(BaepInterventionProtocol::class, 'baep_protocol_id');
    }

    protected static function newFactory(): BaepSensoryDetailFactory
    {
        return BaepSensoryDetailFactory::new();
    }
}
