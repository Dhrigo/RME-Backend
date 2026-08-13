<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordBaepStimulationProtocolDetail\Http\Controllers\BaepStimulationProtocolDetailController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('baep-stimulation-protocol-details', BaepStimulationProtocolDetailController::class)
        ->only(['index', 'store', 'show'])
        ->parameters(['baep-stimulation-protocol-details' => 'record']);
});
