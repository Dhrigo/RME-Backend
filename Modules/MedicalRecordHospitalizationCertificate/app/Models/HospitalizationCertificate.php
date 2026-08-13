<?php

namespace Modules\MedicalRecordHospitalizationCertificate\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\GeneralDoctor\Models\Doctor;
use Modules\Auth\Models\User;
use Modules\MedicalRecordHospitalizationCertificate\Database\Factories\HospitalizationCertificateFactory;

class HospitalizationCertificate extends Model
{
    use HasFactory;

    protected $table = 'hospitalization_certificates';

    protected $fillable = [
        'letter_number',
        'patient_id',
        'visit_id',
        'doctor_id',
        'issue_date',
        'admission_date',
        'estimated_duration_days',
        'ward_name',
        'diagnosis',
        'remarks',
        'created_by',
    ];

    protected $casts = [
        'issue_date' => 'date',
        'admission_date' => 'date',
        'estimated_duration_days' => 'integer',
    ];

    protected static function newFactory(): HospitalizationCertificateFactory
    {
        return HospitalizationCertificateFactory::new();
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
