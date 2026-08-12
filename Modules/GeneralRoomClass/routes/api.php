<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralRoomClass\Http\Controllers\RoomClassController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('room-classes', RoomClassController::class);
});
