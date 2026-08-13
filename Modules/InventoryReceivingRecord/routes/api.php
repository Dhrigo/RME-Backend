<?php

use Illuminate\Support\Facades\Route;
use Modules\InventoryReceivingRecord\Http\Controllers\ReceivingRecordController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('receiving-records', ReceivingRecordController::class)->only(['index', 'store', 'show']);
});
