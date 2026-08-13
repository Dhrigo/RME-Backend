<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordIcd10CauseOfDeathCode\Http\Controllers\Icd10CauseOfDeathCodeController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('icd10-cause-of-death-codes', Icd10CauseOfDeathCodeController::class)->only(['index', 'store', 'show', 'update', 'destroy'])->parameters(['icd10-cause-of-death-codes' => 'record']);
});
