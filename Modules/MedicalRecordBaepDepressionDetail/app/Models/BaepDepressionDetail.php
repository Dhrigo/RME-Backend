<?php

namespace Modules\MedicalRecordBaepDepressionDetail\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\MedicalRecordBaepInterventionProtocol\Models\BaepInterventionProtocol;
use Modules\MedicalRecordBaepDepressionDetail\Database\Factories\BaepDepressionDetailFactory;

class BaepDepressionDetail extends Model
{
    use HasFactory;

    protected $table = 'baep_depression_details';

    protected $fillable = [
        'baep_protocol_id',
        'scale_used',
        'score',
        'severity_level',
        'symptoms_observed',
    ];

    public function baepProtocol(): BelongsTo
    {
        return $this->belongsTo(BaepInterventionProtocol::class, 'baep_protocol_id');
    }

    protected static function newFactory(): BaepDepressionDetailFactory
    {
        return BaepDepressionDetailFactory::new();
    }
}
