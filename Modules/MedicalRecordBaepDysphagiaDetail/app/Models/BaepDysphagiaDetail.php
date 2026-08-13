<?php

namespace Modules\MedicalRecordBaepDysphagiaDetail\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\MedicalRecordBaepInterventionProtocol\Models\BaepInterventionProtocol;
use Modules\MedicalRecordBaepDysphagiaDetail\Database\Factories\BaepDysphagiaDetailFactory;

class BaepDysphagiaDetail extends Model
{
    use HasFactory;

    protected $table = 'baep_dysphagia_details';

    protected $fillable = [
        'baep_protocol_id',
        'swallowing_test_used',
        'severity_level',
        'aspiration_risk',
        'diet_texture_recommendation',
    ];

    protected function casts(): array
    {
        return [
            'aspiration_risk' => 'boolean',
        ];
    }

    public function baepProtocol(): BelongsTo
    {
        return $this->belongsTo(BaepInterventionProtocol::class, 'baep_protocol_id');
    }

    protected static function newFactory(): BaepDysphagiaDetailFactory
    {
        return BaepDysphagiaDetailFactory::new();
    }
}
