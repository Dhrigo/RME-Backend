<?php

namespace Modules\MedicalRecordAbciProcedure\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\GeneralDoctor\Models\Doctor;
use Modules\Auth\Models\User;
use Modules\MedicalRecordAbciProcedure\Database\Factories\AbciProcedureFactory;

class AbciProcedure extends Model
{
    use HasFactory;

    protected $table = 'abci_procedures';

    protected $fillable = [
        'patient_id',
        'visit_id',
        'doctor_id',
        'procedure_date',
        'indication',
        'procedure_details',
        'outcome',
        'notes',
        'created_by',
    ];

    protected $casts = [
        'procedure_date' => 'datetime',
    ];

    protected static function newFactory(): AbciProcedureFactory
    {
        return AbciProcedureFactory::new();
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
