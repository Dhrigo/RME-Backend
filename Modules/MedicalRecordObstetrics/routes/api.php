<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordObstetrics\Http\Controllers\ObstetricsController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('obstetrics-records', ObstetricsController::class)
        ->parameters(['obstetrics-records' => 'record']);
});
