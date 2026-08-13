<?php

use Illuminate\Support\Facades\Route;
use Modules\PembayaranEdc\Http\Controllers\EdcController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('edc-transactions', EdcController::class)->only(['index', 'store', 'show', 'update']);
});
