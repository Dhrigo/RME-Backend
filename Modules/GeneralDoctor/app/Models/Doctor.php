<?php

namespace Modules\GeneralDoctor\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\GeneralDoctor\Database\Factories\DoctorFactory;
use Modules\GeneralEmployee\Models\Employee;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'specialization',
        'sip_number',
        'is_active',
    ];

    protected static function newFactory(): DoctorFactory
    {
        return DoctorFactory::new();
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
