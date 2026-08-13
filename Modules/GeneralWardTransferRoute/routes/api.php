<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralWardTransferRoute\Http\Controllers\WardTransferRouteController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('ward-transfer-routes', WardTransferRouteController::class)->parameters(['ward-transfer-routes' => 'transfer_route']);
});
