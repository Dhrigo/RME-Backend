<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordTransferMedicationReconciliationItem\Http\Controllers\TransferMedicationReconciliationItemController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('transfer-med-reconciliation-items', TransferMedicationReconciliationItemController::class)
        ->only(['index', 'store', 'show'])
        ->parameters(['transfer-med-reconciliation-items' => 'record']);
});
