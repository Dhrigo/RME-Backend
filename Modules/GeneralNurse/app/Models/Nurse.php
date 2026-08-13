<?php

namespace Modules\GeneralNurse\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\GeneralNurse\Database\Factories\NurseFactory;
use Modules\GeneralEmployee\Models\Employee;

class Nurse extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'nurse_license_number',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function newFactory(): NurseFactory
    {
        return NurseFactory::new();
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
