<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordPatientTransferSheet\Http\Controllers\PatientTransferSheetController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('patient-transfer-sheets', PatientTransferSheetController::class)
        ->parameters(['patient-transfer-sheets' => 'record']);
});
