<?php

use Illuminate\Support\Facades\Route;
use Modules\LayananPrescriptionInitialReview\Http\Controllers\PrescriptionInitialReviewController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('prescription-initial-reviews', PrescriptionInitialReviewController::class)->only(['index', 'store', 'show', 'update', 'destroy'])->parameters(['prescription-initial-reviews' => 'record']);
});
