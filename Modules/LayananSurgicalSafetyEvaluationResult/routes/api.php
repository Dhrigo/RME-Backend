<?php

use Illuminate\Support\Facades\Route;
use Modules\LayananSurgicalSafetyEvaluationResult\Http\Controllers\SurgicalSafetyEvaluationResultController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('surgical-safety-evaluation-results', SurgicalSafetyEvaluationResultController::class)->only(['index', 'store', 'show'])->parameters(['surgical-safety-evaluation-results' => 'sst_result']);
});
