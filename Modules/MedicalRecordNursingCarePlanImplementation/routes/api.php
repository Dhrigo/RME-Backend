<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordNursingCarePlanImplementation\Http\Controllers\NursingCarePlanImplementationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('nursing-care-plan-implementations', NursingCarePlanImplementationController::class)->only(['index', 'store', 'show', 'update', 'destroy'])->parameters(['nursing-care-plan-implementations' => 'record']);
});
