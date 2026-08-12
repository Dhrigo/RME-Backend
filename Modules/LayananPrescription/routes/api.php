<?php

use Illuminate\Support\Facades\Route;
use Modules\LayananPrescription\Http\Controllers\PrescriptionController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('prescriptions', PrescriptionController::class)->only(['index', 'store', 'show']);
});
