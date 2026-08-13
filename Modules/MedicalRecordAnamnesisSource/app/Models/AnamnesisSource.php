<?php

namespace Modules\MedicalRecordAnamnesisSource\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\MedicalRecordAnamnesis\Models\Anamnesis;
use Modules\MedicalRecordAnamnesisSource\Database\Factories\AnamnesisSourceFactory;

class AnamnesisSource extends Model
{
    use HasFactory;

    protected $fillable = [
        'anamnesis_id',
        'source_type',
        'source_name',
        'relationship',
        'notes',
    ];

    public function anamnesis(): BelongsTo
    {
        return $this->belongsTo(\Modules\MedicalRecordAnamnesis\Models\Anamnesis::class);
    }

    protected static function newFactory(): AnamnesisSourceFactory
    {
        return AnamnesisSourceFactory::new();
    }
}
