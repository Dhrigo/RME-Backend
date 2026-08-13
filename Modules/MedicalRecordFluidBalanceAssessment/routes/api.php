<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordFluidBalanceAssessment\Http\Controllers\FluidBalanceAssessmentController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('fluid-balance-assessments', FluidBalanceAssessmentController::class)
        ->parameters(['fluid-balance-assessments' => 'record']);
});
