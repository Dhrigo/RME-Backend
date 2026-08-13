<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordRecordFileLoan\Http\Controllers\RecordFileLoanController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('record-file-loans', RecordFileLoanController::class)
        ->parameters(['record-file-loans' => 'record']);
});
