<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordInpatientCarePlan\Http\Controllers\InpatientCarePlanController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('inpatient-care-plans', InpatientCarePlanController::class)
        ->only(['index', 'store', 'show'])
        ->parameters(['inpatient-care-plans' => 'record']);
});
