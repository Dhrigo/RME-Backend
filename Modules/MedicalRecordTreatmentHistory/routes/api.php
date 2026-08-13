<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordTreatmentHistory\Http\Controllers\TreatmentHistoryController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('treatment-histories', TreatmentHistoryController::class)
        ->only(['index', 'store', 'show'])
        ->parameters(['treatment-histories' => 'record']);
});
