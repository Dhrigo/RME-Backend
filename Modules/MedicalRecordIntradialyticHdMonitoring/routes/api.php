<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordIntradialyticHdMonitoring\Http\Controllers\IntradialyticHdMonitoringController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('intradialytic-hd-monitorings', IntradialyticHdMonitoringController::class)
        ->parameters(['intradialytic-hd-monitorings' => 'record']);
});
