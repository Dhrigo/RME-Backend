<?php

use Illuminate\Support\Facades\Route;
use Modules\LayananPharmacyOutpatientQueue\Http\Controllers\PharmacyOutpatientQueueController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('pharmacy-outpatient-queues', PharmacyOutpatientQueueController::class)->only(['index', 'store', 'show', 'update'])->parameters(['pharmacy-outpatient-queues' => 'queue']);
});
