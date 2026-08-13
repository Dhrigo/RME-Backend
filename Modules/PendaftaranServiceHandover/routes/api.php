<?php

use Illuminate\Support\Facades\Route;
use Modules\PendaftaranServiceHandover\Http\Controllers\ServiceHandoverController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('service-handovers', ServiceHandoverController::class)->only(['index', 'store', 'show', 'update']);
});
