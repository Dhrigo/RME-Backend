<?php

use Illuminate\Support\Facades\Route;
use Modules\PendaftaranRegistration\Http\Controllers\RegistrationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('registrations', RegistrationController::class);
});
