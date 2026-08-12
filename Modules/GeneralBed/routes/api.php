<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralBed\Http\Controllers\BedController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('beds', BedController::class);
});
