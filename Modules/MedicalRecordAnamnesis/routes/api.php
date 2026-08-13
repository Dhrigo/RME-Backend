<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordAnamnesis\Http\Controllers\AnamnesisController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('anamneses', AnamnesisController::class)->only(['index', 'store', 'show', 'update', 'destroy'])->parameters(['anamneses' => 'record']);
});
