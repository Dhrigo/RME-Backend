<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordIcd10Code\Http\Controllers\Icd10CodeController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('icd10-codes', Icd10CodeController::class)->only(['index', 'store', 'show', 'update', 'destroy'])->parameters(['icd10-codes' => 'record']);
});
