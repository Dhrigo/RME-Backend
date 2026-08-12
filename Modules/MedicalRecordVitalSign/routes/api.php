<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordVitalSign\Http\Controllers\VitalSignController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('vital-signs', VitalSignController::class)->only(['index', 'store', 'show']);
});
