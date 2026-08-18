<?php

namespace Modules\GeneralStaffWardAssignment\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\GeneralStaffWardAssignment\Database\Factories\StaffWardAssignmentFactory;
use Modules\GeneralStaffMember\Models\StaffMember;
use Modules\GeneralWard\Models\Ward;

class StaffWardAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_member_id',
        'ward_id',
        'assigned_at',
        'is_active',
    ];

    protected $casts = [
        'assigned_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    protected static function newFactory(): StaffWardAssignmentFactory
    {
        return StaffWardAssignmentFactory::new();
    }

    public function staffMember()
    {
        return $this->belongsTo(StaffMember::class);
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }
}
