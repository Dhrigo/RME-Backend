<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordPlanAndTherapy\Http\Controllers\PlanAndTherapyController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('plan-and-therapies', PlanAndTherapyController::class)
        ->only(['index', 'store', 'show'])
        ->parameters(['plan-and-therapies' => 'record']);
});
