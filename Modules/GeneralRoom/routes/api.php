<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralRoom\Http\Controllers\RoomController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('rooms', RoomController::class);
});
