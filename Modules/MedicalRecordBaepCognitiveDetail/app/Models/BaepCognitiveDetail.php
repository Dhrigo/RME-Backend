<?php

namespace Modules\MedicalRecordBaepCognitiveDetail\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\MedicalRecordBaepInterventionProtocol\Models\BaepInterventionProtocol;
use Modules\MedicalRecordBaepCognitiveDetail\Database\Factories\BaepCognitiveDetailFactory;

class BaepCognitiveDetail extends Model
{
    use HasFactory;

    protected $table = 'baep_cognitive_details';

    protected $fillable = [
        'baep_protocol_id',
        'scale_used',
        'score',
        'domains_affected',
    ];

    public function baepProtocol(): BelongsTo
    {
        return $this->belongsTo(BaepInterventionProtocol::class, 'baep_protocol_id');
    }

    protected static function newFactory(): BaepCognitiveDetailFactory
    {
        return BaepCognitiveDetailFactory::new();
    }
}
