<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordNursingCarePlan\Http\Controllers\NursingCarePlanController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('nursing-care-plans', NursingCarePlanController::class)->only(['index', 'store', 'show', 'update', 'destroy'])->parameters(['nursing-care-plans' => 'record']);
});
