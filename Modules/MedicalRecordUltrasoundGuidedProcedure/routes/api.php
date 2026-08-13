<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordUltrasoundGuidedProcedure\Http\Controllers\UltrasoundGuidedProcedureController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('ultrasound-guided-procedures', UltrasoundGuidedProcedureController::class)->parameters([
        'ultrasound-guided-procedures' => 'procedure',
    ]);
});
