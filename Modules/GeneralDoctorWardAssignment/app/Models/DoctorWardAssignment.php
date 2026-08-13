<?php

namespace Modules\GeneralDoctorWardAssignment\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\GeneralDoctorWardAssignment\Database\Factories\DoctorWardAssignmentFactory;
use Modules\GeneralDoctor\Models\Doctor;
use Modules\GeneralWard\Models\Ward;

class DoctorWardAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'ward_id',
        'assigned_at',
        'schedule_day',
    ];

    protected $casts = [
        'assigned_at' => 'datetime',
    ];

    protected static function newFactory(): DoctorWardAssignmentFactory
    {
        return DoctorWardAssignmentFactory::new();
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }
}
