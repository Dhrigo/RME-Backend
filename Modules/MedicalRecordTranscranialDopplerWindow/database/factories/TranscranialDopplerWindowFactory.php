<?php

namespace Modules\MedicalRecordTranscranialDopplerWindow\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\MedicalRecordTranscranialDopplerExamination\Models\TranscranialDopplerExamination;
use Modules\MedicalRecordTranscranialDopplerWindow\Models\TranscranialDopplerWindow;

class TranscranialDopplerWindowFactory extends Factory
{
    protected $model = TranscranialDopplerWindow::class;

    public function definition(): array
    {
        return [
            'transcranial_doppler_examination_id' => TranscranialDopplerExamination::factory(),
            'window_site' => 'temporal',
            'signal_quality' => 'good',
            'depth_mm' => 50,
            'velocity_cm_s' => 52.0,
        ];
    }
}
