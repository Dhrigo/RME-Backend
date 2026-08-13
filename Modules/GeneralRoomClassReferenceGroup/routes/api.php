<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralRoomClassReferenceGroup\Http\Controllers\RoomClassReferenceGroupController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('room-class-reference-groups', RoomClassReferenceGroupController::class);
});
