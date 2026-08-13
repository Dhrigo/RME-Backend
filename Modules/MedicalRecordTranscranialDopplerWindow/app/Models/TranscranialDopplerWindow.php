<?php

namespace Modules\MedicalRecordTranscranialDopplerWindow\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\MedicalRecordTranscranialDopplerWindow\Database\Factories\TranscranialDopplerWindowFactory;

class TranscranialDopplerWindow extends Model
{
    use HasFactory;

    protected $table = 'transcranial_doppler_windows';

    protected $fillable = [
        'transcranial_doppler_examination_id',
        'window_site',
        'signal_quality',
        'depth_mm',
        'velocity_cm_s',
    ];


    protected static function newFactory(): TranscranialDopplerWindowFactory
    {
        return TranscranialDopplerWindowFactory::new();
    }
}
