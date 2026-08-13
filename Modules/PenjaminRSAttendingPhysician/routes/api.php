<?php

use Illuminate\Support\Facades\Route;
use Modules\PenjaminRSAttendingPhysician\Http\Controllers\PenjaminRSAttendingPhysicianController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('attending-physicians', PenjaminRSAttendingPhysicianController::class)
        ->parameters(['attending-physicians' => 'attending_physician']);
});
