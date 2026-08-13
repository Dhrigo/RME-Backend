<?php

use Illuminate\Support\Facades\Route;
use Modules\PendaftaranReservation\Http\Controllers\ReservationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('reservations', ReservationController::class)->except(['destroy']);
});
