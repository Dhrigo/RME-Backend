<?php

use Illuminate\Support\Facades\Route;
use Modules\PembayaranTransfer\Http\Controllers\TransferController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('bank-transfers', TransferController::class)->only(['index', 'store', 'show', 'update']);
});
