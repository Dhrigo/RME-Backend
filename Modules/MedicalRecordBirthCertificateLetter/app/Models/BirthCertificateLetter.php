<?php

namespace Modules\MedicalRecordBirthCertificateLetter\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\GeneralDoctor\Models\Doctor;
use Modules\Auth\Models\User;
use Modules\MedicalRecordBirthCertificateLetter\Database\Factories\BirthCertificateLetterFactory;

class BirthCertificateLetter extends Model
{
    use HasFactory;

    protected $table = 'birth_certificate_letters';

    protected $fillable = [
        'letter_number',
        'patient_id',
        'mother_patient_id',
        'visit_id',
        'doctor_id',
        'issue_date',
        'child_name',
        'birth_date_time',
        'birth_weight_grams',
        'birth_length_cm',
        'gender',
        'remarks',
        'created_by',
    ];

    protected $casts = [
        'issue_date' => 'date',
        'birth_date_time' => 'datetime',
        'birth_weight_grams' => 'integer',
        'birth_length_cm' => 'decimal:2',
    ];

    protected static function newFactory(): BirthCertificateLetterFactory
    {
        return BirthCertificateLetterFactory::new();
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function mother()
    {
        return $this->belongsTo(Patient::class, 'mother_patient_id');
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
