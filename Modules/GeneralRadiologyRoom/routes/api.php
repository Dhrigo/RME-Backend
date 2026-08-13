<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralRadiologyRoom\Http\Controllers\GeneralRadiologyRoomController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('radiology-rooms', GeneralRadiologyRoomController::class)->parameters(['radiology-rooms' => 'radiologyRoom']);
});
