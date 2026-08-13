<?php

use Illuminate\Support\Facades\Route;
use Modules\LayananMedicationIteration\Http\Controllers\MedicationIterationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('medication-iterations', MedicationIterationController::class)->only(['index', 'store', 'show', 'update'])->parameters(['medication-iterations' => 'iteration']);
});
