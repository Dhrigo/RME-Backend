<?php

use Illuminate\Support\Facades\Route;
use Modules\PendaftaranFunction\Http\Controllers\PendaftaranFunctionController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('registration-functions', PendaftaranFunctionController::class)
        ->parameters(['registration-functions' => 'registration_function']);
});
