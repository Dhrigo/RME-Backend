<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordDischargePlanningScreening\Http\Controllers\DischargePlanningScreeningController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('discharge-planning-screenings', DischargePlanningScreeningController::class)->only(['index', 'store', 'show', 'update', 'destroy'])->parameters(['discharge-planning-screenings' => 'record']);
});
