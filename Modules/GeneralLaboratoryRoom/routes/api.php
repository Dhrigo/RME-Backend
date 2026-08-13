<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralLaboratoryRoom\Http\Controllers\GeneralLaboratoryRoomController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('laboratory-rooms', GeneralLaboratoryRoomController::class)->parameters(['laboratory-rooms' => 'laboratoryRoom']);
});
