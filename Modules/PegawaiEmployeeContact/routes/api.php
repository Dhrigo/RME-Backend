<?php

use Illuminate\Support\Facades\Route;
use Modules\PegawaiEmployeeContact\Http\Controllers\EmployeeContactController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('employee-contacts', EmployeeContactController::class);
});
