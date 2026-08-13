<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordDischargeMedicationReconciliation\Http\Controllers\DischargeMedicationReconciliationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('discharge-med-reconciliations', DischargeMedicationReconciliationController::class)
        ->only(['index', 'store', 'show'])
        ->parameters(['discharge-med-reconciliations' => 'record']);
});
