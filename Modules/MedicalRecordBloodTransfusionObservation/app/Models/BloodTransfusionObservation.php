<?php

namespace Modules\MedicalRecordBloodTransfusionObservation\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordBloodTransfusionObservation\Database\Factories\BloodTransfusionObservationFactory;

class BloodTransfusionObservation extends Model
{
    use HasFactory;

    protected $table = 'blood_transfusion_observations';

    protected $fillable = [
        'blood_transfusion_id',
        'observed_at',
        'temperature_c',
        'pulse_rate',
        'blood_pressure',
        'reaction_signs',
        'volume_transfused_ml',
        'notes',
    ];

    protected $casts = [
        'observed_at' => 'datetime',
    ];

    protected static function newFactory(): BloodTransfusionObservationFactory
    {
        return BloodTransfusionObservationFactory::new();
    }
}
