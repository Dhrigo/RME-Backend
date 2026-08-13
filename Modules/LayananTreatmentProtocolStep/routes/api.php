<?php

use Illuminate\Support\Facades\Route;
use Modules\LayananTreatmentProtocolStep\Http\Controllers\TreatmentProtocolStepController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('treatment-protocol-steps', TreatmentProtocolStepController::class)->only(['index', 'store', 'show', 'update', 'destroy'])->parameters(['treatment-protocol-steps' => 'record']);
});
