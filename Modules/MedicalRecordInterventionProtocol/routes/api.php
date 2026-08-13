<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordInterventionProtocol\Http\Controllers\InterventionProtocolController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('intervention-protocols', InterventionProtocolController::class)
        ->only(['index', 'store', 'show'])
        ->parameters(['intervention-protocols' => 'record']);
});
