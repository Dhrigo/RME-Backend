<?php

use Illuminate\Support\Facades\Route;
use Modules\BpjsAplicares\Http\Controllers\AplicaresBedAvailabilityController;
use Modules\BpjsAplicares\Http\Controllers\AplicaresReferensiController;
use Modules\BpjsAplicares\Http\Controllers\AplicaresRoomController;

Route::middleware(['auth:sanctum'])->prefix('v1/aplicares')->group(function () {
    Route::get('referensi/kamar/{query?}', [AplicaresReferensiController::class, 'kamar']);

    Route::get('rooms', [AplicaresRoomController::class, 'index']);
    Route::post('rooms', [AplicaresRoomController::class, 'store']);
    Route::get('rooms/{aplicares_room_sync}', [AplicaresRoomController::class, 'show']);
    Route::delete('rooms/{aplicares_room_sync}', [AplicaresRoomController::class, 'destroy']);

    Route::post('rooms/{aplicares_room_sync}/beds', [AplicaresBedAvailabilityController::class, 'update']);
});
