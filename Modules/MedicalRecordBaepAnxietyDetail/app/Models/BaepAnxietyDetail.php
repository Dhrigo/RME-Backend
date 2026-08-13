<?php

namespace Modules\MedicalRecordBaepAnxietyDetail\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\MedicalRecordBaepInterventionProtocol\Models\BaepInterventionProtocol;
use Modules\MedicalRecordBaepAnxietyDetail\Database\Factories\BaepAnxietyDetailFactory;

class BaepAnxietyDetail extends Model
{
    use HasFactory;

    protected $table = 'baep_anxiety_details';

    protected $fillable = [
        'baep_protocol_id',
        'scale_used',
        'score',
        'severity_level',
    ];

    public function baepProtocol(): BelongsTo
    {
        return $this->belongsTo(BaepInterventionProtocol::class, 'baep_protocol_id');
    }

    protected static function newFactory(): BaepAnxietyDetailFactory
    {
        return BaepAnxietyDetailFactory::new();
    }
}
