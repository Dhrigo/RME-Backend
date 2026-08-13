<?php

use Illuminate\Support\Facades\Route;
use Modules\LayananTreatmentProtocol\Http\Controllers\TreatmentProtocolController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('treatment-protocols', TreatmentProtocolController::class)->only(['index', 'store', 'show', 'update', 'destroy'])->parameters(['treatment-protocols' => 'record']);
});
