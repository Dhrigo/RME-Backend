<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordTranscranialDopplerWindow\Http\Controllers\TranscranialDopplerWindowController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('tcd-windows', TranscranialDopplerWindowController::class)
        ->parameters(['tcd-windows' => 'record']);
});
