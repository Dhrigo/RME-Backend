<?php

namespace Modules\MedicalRecordUltrasoundGuidedProcedure\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\GeneralDoctor\Models\Doctor;
use Modules\Auth\Models\User;
use Modules\MedicalRecordUltrasoundGuidedProcedure\Database\Factories\UltrasoundGuidedProcedureFactory;

class UltrasoundGuidedProcedure extends Model
{
    use HasFactory;

    protected $table = 'ultrasound_guided_procedures';

    protected $fillable = [
        'patient_id',
        'visit_id',
        'doctor_id',
        'procedure_name',
        'target_site',
        'needle_gauge',
        'findings_and_outcome',
        'complications',
        'performed_at',
        'created_by',
    ];

    protected $casts = [
        'performed_at' => 'datetime',
    ];

    protected static function newFactory(): UltrasoundGuidedProcedureFactory
    {
        return UltrasoundGuidedProcedureFactory::new();
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function visit()
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
