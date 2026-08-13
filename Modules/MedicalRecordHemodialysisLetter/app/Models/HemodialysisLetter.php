<?php

namespace Modules\MedicalRecordHemodialysisLetter\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\GeneralDoctor\Models\Doctor;
use Modules\Auth\Models\User;
use Modules\MedicalRecordHemodialysisLetter\Database\Factories\HemodialysisLetterFactory;

class HemodialysisLetter extends Model
{
    use HasFactory;

    protected $table = 'hemodialysis_letters';

    protected $fillable = [
        'letter_number',
        'patient_id',
        'visit_id',
        'doctor_id',
        'issue_date',
        'diagnosis',
        'hd_frequency_per_week',
        'vascular_access',
        'remarks',
        'created_by',
    ];

    protected $casts = [
        'issue_date' => 'date',
        'hd_frequency_per_week' => 'integer',
    ];

    protected static function newFactory(): HemodialysisLetterFactory
    {
        return HemodialysisLetterFactory::new();
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
