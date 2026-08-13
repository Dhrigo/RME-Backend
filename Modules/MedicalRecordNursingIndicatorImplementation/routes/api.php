<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordNursingIndicatorImplementation\Http\Controllers\NursingIndicatorImplementationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('nursing-indicator-implementations', NursingIndicatorImplementationController::class)->only(['index', 'store', 'show', 'destroy'])->parameters(['nursing-indicator-implementations' => 'record']);
});
