<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordMedicalCheckupResult\Http\Controllers\MedicalCheckupResultController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('medical-checkup-results', MedicalCheckupResultController::class)->only(['index', 'store', 'show', 'update', 'destroy'])->parameters(['medical-checkup-results' => 'record']);
});
