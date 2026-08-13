<?php

use Illuminate\Support\Facades\Route;
use Modules\PendaftaranCoManagement\Http\Controllers\CoManagementController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('comanagements', CoManagementController::class)->only(['index', 'store', 'show']);
});
