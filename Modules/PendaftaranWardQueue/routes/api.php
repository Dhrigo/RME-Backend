<?php

use Illuminate\Support\Facades\Route;
use Modules\PendaftaranWardQueue\Http\Controllers\WardQueueController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('ward-queues', WardQueueController::class)->only(['index', 'store', 'show', 'update']);
});
