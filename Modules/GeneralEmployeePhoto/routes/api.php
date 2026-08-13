<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralEmployeePhoto\Http\Controllers\GeneralEmployeePhotoController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('employee-photos', GeneralEmployeePhotoController::class)->parameters(['employee-photos' => 'employeePhoto']);
});
