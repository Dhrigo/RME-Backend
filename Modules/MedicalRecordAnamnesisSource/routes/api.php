<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordAnamnesisSource\Http\Controllers\AnamnesisSourceController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('anamnesis-sources', AnamnesisSourceController::class)->only(['index', 'store', 'show', 'update', 'destroy'])->parameters(['anamnesis-sources' => 'record']);
});
