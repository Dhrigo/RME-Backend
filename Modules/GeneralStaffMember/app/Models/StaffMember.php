<?php

namespace Modules\GeneralStaffMember\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\GeneralStaffMember\Database\Factories\StaffMemberFactory;
use Modules\GeneralEmployee\Models\Employee;

class StaffMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'staff_role',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function newFactory(): StaffMemberFactory
    {
        return StaffMemberFactory::new();
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
