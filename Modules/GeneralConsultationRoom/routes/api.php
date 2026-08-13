<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralConsultationRoom\Http\Controllers\GeneralConsultationRoomController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('consultation-rooms', GeneralConsultationRoomController::class)->parameters(['consultation-rooms' => 'consultationRoom']);
});
