<?php

namespace Modules\MedicalRecordSurgeryPerformer\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\MedicalRecordSurgeryPerformer\Database\Factories\SurgeryPerformerFactory;

class SurgeryPerformer extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'surgery_performers';

    protected $fillable = [
        'surgery_id',
        'visit_id',
        'doctor_id',
        'role',
        'notes',
    ];

    protected static function newFactory(): SurgeryPerformerFactory
    {
        return SurgeryPerformerFactory::new();
    }
}
