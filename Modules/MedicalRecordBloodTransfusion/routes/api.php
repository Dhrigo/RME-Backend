<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordBloodTransfusion\Http\Controllers\BloodTransfusionController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('blood-transfusions', BloodTransfusionController::class)->only(['index', 'store', 'show', 'update']);
});
