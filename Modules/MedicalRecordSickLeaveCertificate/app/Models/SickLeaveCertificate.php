<?php

namespace Modules\MedicalRecordSickLeaveCertificate\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\GeneralDoctor\Models\Doctor;
use Modules\Auth\Models\User;
use Modules\MedicalRecordSickLeaveCertificate\Database\Factories\SickLeaveCertificateFactory;

class SickLeaveCertificate extends Model
{
    use HasFactory;

    protected $table = 'sick_leave_certificates';

    protected $fillable = [
        'letter_number',
        'patient_id',
        'visit_id',
        'doctor_id',
        'issue_date',
        'start_date',
        'end_date',
        'duration_days',
        'diagnosis',
        'remarks',
        'created_by',
    ];

    protected $casts = [
        'issue_date' => 'date',
        'start_date' => 'date',
        'end_date' => 'date',
        'duration_days' => 'integer',
    ];

    protected static function newFactory(): SickLeaveCertificateFactory
    {
        return SickLeaveCertificateFactory::new();
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
