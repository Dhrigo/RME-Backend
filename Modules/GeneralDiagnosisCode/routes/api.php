<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralDiagnosisCode\Http\Controllers\DiagnosisCodeController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('diagnosis-codes', DiagnosisCodeController::class);
});
