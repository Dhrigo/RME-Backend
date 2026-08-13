<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordTransferMedicationReconciliation\Http\Controllers\TransferMedicationReconciliationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('transfer-med-reconciliations', TransferMedicationReconciliationController::class)
        ->only(['index', 'store', 'show'])
        ->parameters(['transfer-med-reconciliations' => 'record']);
});
