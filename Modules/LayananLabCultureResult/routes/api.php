<?php

use Illuminate\Support\Facades\Route;
use Modules\LayananLabCultureResult\Http\Controllers\LabCultureResultController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('lab-culture-results', LabCultureResultController::class)->only(['index', 'store', 'show', 'update'])->parameters(['lab-culture-results' => 'culture_result']);
});
