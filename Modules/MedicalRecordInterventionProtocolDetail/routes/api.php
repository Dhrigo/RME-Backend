<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordInterventionProtocolDetail\Http\Controllers\InterventionProtocolDetailController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('intervention-protocol-details', InterventionProtocolDetailController::class)
        ->only(['index', 'store', 'show'])
        ->parameters(['intervention-protocol-details' => 'record']);
});
