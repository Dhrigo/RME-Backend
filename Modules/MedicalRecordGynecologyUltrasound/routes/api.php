<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordGynecologyUltrasound\Http\Controllers\GynecologyUltrasoundController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('gynecology-ultrasounds', GynecologyUltrasoundController::class)->parameters([
        'gynecology-ultrasounds' => 'ultrasound',
    ]);
});
