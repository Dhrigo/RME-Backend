<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordIcd9CmCode\Http\Controllers\Icd9CmCodeController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('icd9-cm-codes', Icd9CmCodeController::class)->only(['index', 'store', 'show', 'update', 'destroy'])->parameters(['icd9-cm-codes' => 'record']);
});
