<?php

use Illuminate\Support\Facades\Route;
use Modules\PembayaranDeposit\Http\Controllers\DepositController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('deposits', DepositController::class)->only(['index', 'store', 'show', 'update']);
});
