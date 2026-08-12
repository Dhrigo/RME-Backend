<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordSurgery\Http\Controllers\SurgeryController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('surgeries', SurgeryController::class)->only(['index', 'store', 'show', 'update']);
});
