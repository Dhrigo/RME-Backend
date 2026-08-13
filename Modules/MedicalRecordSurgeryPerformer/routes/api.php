<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordSurgeryPerformer\Http\Controllers\SurgeryPerformerController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('surgery-performers', SurgeryPerformerController::class)
        ->parameters(['surgery-performers' => 'record']);
});
