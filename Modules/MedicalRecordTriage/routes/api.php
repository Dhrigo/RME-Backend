<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordTriage\Http\Controllers\TriageController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('triages', TriageController::class)->only(['index', 'store', 'show']);
});
