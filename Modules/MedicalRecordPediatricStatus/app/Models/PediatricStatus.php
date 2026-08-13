<?php

namespace Modules\MedicalRecordPediatricStatus\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\Auth\Models\User;
use Modules\MedicalRecordPediatricStatus\Database\Factories\PediatricStatusFactory;

class PediatricStatus extends Model
{
    use HasFactory;

    protected $table = 'pediatric_statuses';

    protected $fillable = [
        'patient_id',
        'visit_id',
        'birth_weight_grams',
        'birth_length_cm',
        'head_circumference_cm',
        'gestational_age_weeks',
        'immunization_status',
        'developmental_milestones',
        'notes',
        'recorded_at',
        'created_by',
    ];

    protected $casts = [
        'birth_weight_grams' => 'integer',
        'birth_length_cm' => 'decimal:2',
        'head_circumference_cm' => 'decimal:2',
        'gestational_age_weeks' => 'integer',
        'recorded_at' => 'datetime',
    ];

    protected static function newFactory(): PediatricStatusFactory
    {
        return PediatricStatusFactory::new();
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function visit()
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
