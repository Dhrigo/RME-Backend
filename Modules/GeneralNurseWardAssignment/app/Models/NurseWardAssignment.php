<?php

namespace Modules\GeneralNurseWardAssignment\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\GeneralNurseWardAssignment\Database\Factories\NurseWardAssignmentFactory;
use Modules\GeneralNurse\Models\Nurse;
use Modules\GeneralWard\Models\Ward;

class NurseWardAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'nurse_id',
        'ward_id',
        'shift',
        'assigned_at',
    ];

    protected $casts = [
        'assigned_at' => 'datetime',
    ];

    protected static function newFactory(): NurseWardAssignmentFactory
    {
        return NurseWardAssignmentFactory::new();
    }

    public function nurse()
    {
        return $this->belongsTo(Nurse::class);
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }
}
