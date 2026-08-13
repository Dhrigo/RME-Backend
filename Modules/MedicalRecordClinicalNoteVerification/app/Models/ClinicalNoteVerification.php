<?php

namespace Modules\MedicalRecordClinicalNoteVerification\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\MedicalRecordClinicalNote\Models\ClinicalNote;
use Modules\GeneralDoctor\Models\Doctor;
use Modules\Auth\Models\User;
use Modules\MedicalRecordClinicalNoteVerification\Database\Factories\ClinicalNoteVerificationFactory;

class ClinicalNoteVerification extends Model
{
    use HasFactory;

    protected $table = 'clinical_note_verifications';

    protected $fillable = [
        'clinical_note_id',
        'verifier_doctor_id',
        'verification_status',
        'verified_at',
        'notes',
        'created_by',
    ];

    protected $casts = [
        'clinical_note_id' => 'integer',
        'verifier_doctor_id' => 'integer',
        'verified_at' => 'datetime',
    ];

    protected static function newFactory(): ClinicalNoteVerificationFactory
    {
        return ClinicalNoteVerificationFactory::new();
    }

    public function clinicalNote()
    {
        return $this->belongsTo(ClinicalNote::class, 'clinical_note_id');
    }

    public function verifierDoctor()
    {
        return $this->belongsTo(Doctor::class, 'verifier_doctor_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
