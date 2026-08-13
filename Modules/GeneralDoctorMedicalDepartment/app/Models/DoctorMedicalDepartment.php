<?php

namespace Modules\GeneralDoctorMedicalDepartment\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\GeneralDoctorMedicalDepartment\Database\Factories\DoctorMedicalDepartmentFactory;
use Modules\GeneralDoctor\Models\Doctor;
use Modules\GeneralMedicalDepartment\Models\MedicalDepartment;

class DoctorMedicalDepartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'medical_department_id',
        'is_head',
    ];

    protected $casts = [
        'is_head' => 'boolean',
    ];

    protected static function newFactory(): DoctorMedicalDepartmentFactory
    {
        return DoctorMedicalDepartmentFactory::new();
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function medicalDepartment()
    {
        return $this->belongsTo(MedicalDepartment::class);
    }
}
