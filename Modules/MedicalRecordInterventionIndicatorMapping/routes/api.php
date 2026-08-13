<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordInterventionIndicatorMapping\Http\Controllers\InterventionIndicatorMappingController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('intervention-indicator-mappings', InterventionIndicatorMappingController::class)
        ->parameters(['intervention-indicator-mappings' => 'record']);
});
