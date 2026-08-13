<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordDischargeMedicationReconciliationItem\Http\Controllers\DischargeMedicationReconciliationItemController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('discharge-med-reconciliation-items', DischargeMedicationReconciliationItemController::class)
        ->only(['index', 'store', 'show'])
        ->parameters(['discharge-med-reconciliation-items' => 'record']);
});
