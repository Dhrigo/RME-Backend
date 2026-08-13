<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordAbciProcedure\Http\Controllers\AbciProcedureController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('abci-procedures', AbciProcedureController::class)->parameters([
        'abci-procedures' => 'procedure',
    ]);
});
