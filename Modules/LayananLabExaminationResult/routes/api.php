<?php

use Illuminate\Support\Facades\Route;
use Modules\LayananLabExaminationResult\Http\Controllers\LabExaminationResultController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('lab-examination-results', LabExaminationResultController::class)->only(['index', 'store', 'show'])->parameters(['lab-examination-results' => 'exam_result']);
});
