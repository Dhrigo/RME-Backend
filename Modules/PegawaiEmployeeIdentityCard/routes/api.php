<?php

use Illuminate\Support\Facades\Route;
use Modules\PegawaiEmployeeIdentityCard\Http\Controllers\EmployeeIdentityCardController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('employee-identity-cards', EmployeeIdentityCardController::class);
});
