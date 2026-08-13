<?php

namespace Modules\MedicalRecordBaepMotorDetail\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\MedicalRecordBaepInterventionProtocol\Models\BaepInterventionProtocol;
use Modules\MedicalRecordBaepMotorDetail\Database\Factories\BaepMotorDetailFactory;

class BaepMotorDetail extends Model
{
    use HasFactory;

    protected $table = 'baep_motor_details';

    protected $fillable = [
        'baep_protocol_id',
        'muscle_strength_score',
        'spasticity_level',
        'gait_status',
    ];

    public function baepProtocol(): BelongsTo
    {
        return $this->belongsTo(BaepInterventionProtocol::class, 'baep_protocol_id');
    }

    protected static function newFactory(): BaepMotorDetailFactory
    {
        return BaepMotorDetailFactory::new();
    }
}
