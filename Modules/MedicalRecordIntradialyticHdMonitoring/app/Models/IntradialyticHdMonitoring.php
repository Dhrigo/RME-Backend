<?php

namespace Modules\MedicalRecordIntradialyticHdMonitoring\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\MedicalRecordIntradialyticHdMonitoring\Database\Factories\IntradialyticHdMonitoringFactory;

class IntradialyticHdMonitoring extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'intradialytic_hd_monitorings';

    protected $fillable = [
        'visit_id',
        'patient_id',
        'dialysis_hour',
        'blood_pressure_systolic',
        'blood_pressure_diastolic',
        'blood_flow_rate',
        'dialysate_flow_rate',
        'ultrafiltration_rate',
        'venous_pressure',
        'transmembrane_pressure',
        'symptoms',
        'monitored_at',
    ];

    protected $casts = [
        'dialysis_hour' => 'integer',
        'blood_pressure_systolic' => 'integer',
        'blood_pressure_diastolic' => 'integer',
        'blood_flow_rate' => 'integer',
        'dialysate_flow_rate' => 'integer',
        'ultrafiltration_rate' => 'integer',
        'venous_pressure' => 'integer',
        'transmembrane_pressure' => 'integer',
        'monitored_at' => 'datetime',
    ];

    protected static function newFactory(): IntradialyticHdMonitoringFactory
    {
        return IntradialyticHdMonitoringFactory::new();
    }
}
