<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordProcedureSurgery\Http\Controllers\ProcedureSurgeryController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('procedure-surgeries', ProcedureSurgeryController::class)
        ->parameters(['procedure-surgeries' => 'record']);
});
