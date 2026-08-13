<?php

namespace Modules\MedicalRecordBloodTransfusionDetail\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\MedicalRecordBloodTransfusion\Models\BloodTransfusion;
use Modules\Auth\Models\User;
use Modules\MedicalRecordBloodTransfusionDetail\Database\Factories\BloodTransfusionDetailFactory;

class BloodTransfusionDetail extends Model
{
    use HasFactory;

    protected $table = 'blood_transfusion_details';

    protected $fillable = [
        'transfusion_id',
        'blood_bag_number',
        'blood_type',
        'volume_ml',
        'start_time',
        'end_time',
        'reaction_observed',
        'status',
        'created_by',
    ];

    protected $casts = [
        'transfusion_id' => 'integer',
        'volume_ml' => 'integer',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    protected static function newFactory(): BloodTransfusionDetailFactory
    {
        return BloodTransfusionDetailFactory::new();
    }

    public function transfusion()
    {
        return $this->belongsTo(BloodTransfusion::class, 'transfusion_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
