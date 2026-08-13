<?php

use Illuminate\Support\Facades\Route;
use Modules\PendaftaranBedQueue\Http\Controllers\BedQueueController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('bed-queues', BedQueueController::class)->only(['index', 'store', 'show', 'update']);
});
